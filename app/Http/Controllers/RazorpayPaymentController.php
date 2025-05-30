<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class RazorpayPaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $input = $request->all();
        $employerId = Session::get('client_login_id');
        
        DB::table('client_purchased_plans')
        ->where('employer_id', $employerId)
        ->where('subscription_plan_id', $request->plan_id)
        ->where('is_history', 0)
        ->update(['is_history' => 1]);
        
        $totalAmount = $request->price * 100; // Razorpay uses paise

        // Save basic order info before payment
        $orderData = [
            'employer_id' => $employerId,
            'subscription_plan_id' => $request->plan_id,
            'amount_paid' => $request->price/100,
            'currency' => 'INR',
            'gst' => $request->gst,
            'tax_price' => $request->tax_price,
            'status' => 'PENDING',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $orderId = DB::table('client_purchased_plans')->insertGetId($orderData);
        $uniqueOrderId = 'MVLT' . str_pad($orderId, 5, '0', STR_PAD_LEFT);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $razorpayOrder = $api->order->create([
                'receipt' => $uniqueOrderId,
                'amount' => (int)$totalAmount/100,
                'currency' => 'INR',
                'payment_capture' => 1
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Razorpay order creation failed: ' . $e->getMessage());
        }

        $merchantTxnId = 'TXN' . time();

        // Save Razorpay order ID and merchant transaction ID
        DB::table('client_purchased_plans')->where('id', $orderId)->update([
            'mer_transaction_id' => $merchantTxnId,
            'updated_at' => now()
        ]);

        // Render the Razorpay checkout
        echo '<form action="' . url('razorpay-process-response') . '" method="POST" id="razorpay-form">
            ' . csrf_field() . '
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_order_id" value="' . $razorpayOrder['id'] . '">
            <input type="hidden" name="order_id" value="' . $orderId . '">
        </form>

        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            var options = {
                "key": "' . env('RAZORPAY_KEY') . '",
                "amount": "' . $totalAmount . '",
                "currency": "INR",
                "name": "Mellow Voult",
                "description": "Subscription Payment",
                "order_id": "' . $razorpayOrder['id'] . '",
                "handler": function (response) {
                    document.getElementById("razorpay_payment_id").value = response.razorpay_payment_id;
                    document.getElementById("razorpay-form").submit();
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        </script>';
    }

    public function processResponse(Request $request)
    {
        $razorpay_payment_id = $request->input('razorpay_payment_id');
        $orderId = $request->input('order_id');

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $payment = $api->payment->fetch($razorpay_payment_id);

            if ($payment['status'] === 'captured') {
                DB::table('client_purchased_plans')->where('id', $orderId)->update([
                    'razorpay_payment_id' => $payment['id'],
                    'type' => $payment['method'],
                    'status' => 'SUCCESS',
                    'payment_date' => now(),
                    'updated_at' => now()
                ]);

                // Fetch updated order data for email
                $orderData = DB::table('client_purchased_plans')->where('id', $orderId)->first();

                if (!$orderData) {
                    return redirect()->back()->with('error', 'Order not found.');
                }

                // Get employer email
                $employer = DB::table('user_login')->where('id', $orderData->employer_id)->first();

                if ($employer && $employer->email) {
                    // Convert $orderData from object to array
                    $orderArray = (array) $orderData;
                    $this->subscriptionEmail($employer->email, $orderArray);
                }

                return view('front.thanks');
            } else {
                DB::table('client_purchased_plans')->where('id', $orderId)->update([
                    'razorpay_payment_id' => $payment['id'],
                    'status' => 'FAILED',
                    'updated_at' => now()
                ]);

                return redirect()->back()->with('error', 'Payment failed.');
            }
        } catch (\Exception $e) {
            dd('Something went wrong: ' . $e->getMessage());
        }
    }

    // public function subscriptionEmail($toEmail, $orderData)
    // {
    //     $subject = 'Payment Successful - Thank You for Your Purchase';
    
    //     $message = "
    //     <html>
    //     <head><style>
    //         body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; color: #333; }
    //         .container { background: #fff; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; }
    //         h2 { color: #28a745; }
    //         .details { margin-top: 20px; }
    //         .details th { text-align: left; padding-right: 10px; }
    //     </style></head>
    //     <body>
    //         <div class='container'>
    //             <h2>Payment Successful</h2>
    //             <p>Dear Customer,</p>
    //             <p>Thank you for your payment. Here are the details of your transaction:</p>
    //             <table class='details'>
    //                 <tr><th>Transaction ID:</th><td>{$orderData['razorpay_payment_id']}</td></tr>
    //                 <tr><th>Order ID:</th><td>{$orderData['mer_transaction_id']}</td></tr>
    //                 <tr><th>Amount Paid:</th><td>₹" . number_format($orderData['amount_paid'], 2) . "</td></tr>
    //                 <tr><th>Payment Method:</th><td>{$orderData['type']}</td></tr>
    //                 <tr><th>Date:</th><td>" . now()->format('d M Y, h:i A') . "</td></tr>
    //             </table>
    //             <p>If you have any questions, feel free to contact us.</p>
    //             <p>Warm regards,<br>Mellow Voult Team</p>
    //         </div>
    //     </body>
    //     </html>";
    
    //     Mail::send([], [], function ($mail) use ($toEmail, $subject, $message) {
    //         $mail->to($toEmail)
    //             ->subject($subject)
    //             ->setBody($message, 'text/html');
    //     });
    // }
    
    public function subscriptionEmail($toEmail, $orderData)
    {
        $subject = 'Payment Successful - Thank You for Your Purchase';
    
        // 1. Generate PDF from Blade view
        $pdf = PDF::loadView('front.invoice.emp_invoice', ['orderData' => $orderData]);
    
        // 2. Save the PDF to public/invoices
        $fileName = 'invoice_' . $orderData['id'] . '.pdf';
        $tempPath = public_path('invoices/' . $fileName);
    
        // Create directory if it doesn't exist
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0775, true);
        }
    
        // Save PDF to the path
        $pdf->save($tempPath);
    
        // 3. Compose the email content
        $message = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; color: #333; }
                .container { background: #fff; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; }
                h2 { color: #28a745; }
                .details { margin-top: 20px; }
                .details th { text-align: left; padding-right: 10px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Payment Successful</h2>
                <p>Dear Customer,</p>
                <p>Thank you for your payment. Here are the details of your transaction:</p>
                <table class='details'>
                    <tr><th>Transaction ID:</th><td>{$orderData['razorpay_payment_id']}</td></tr>
                    <tr><th>Order ID:</th><td>{$orderData['mer_transaction_id']}</td></tr>
                    <tr><th>Amount Paid:</th><td>₹" . number_format($orderData['amount_paid'], 2) . "</td></tr>
                    <tr><th>Payment Method:</th><td>{$orderData['type']}</td></tr>
                    <tr><th>Date:</th><td>" . now()->format('d M Y, h:i A') . "</td></tr>
                </table>
                <p>If you have any questions, feel free to contact us.</p>
                <p>Warm regards,<br>Mellow Vault Team</p>
            </div>
        </body>
        </html>";
    
        // 4. Send Email with Attachment
        Mail::send([], [], function ($mail) use ($toEmail, $subject, $message, $tempPath, $fileName) {
            $mail->to($toEmail)
                 ->subject($subject)
                 ->setBody($message, 'text/html');
    
            if (file_exists($tempPath)) {
                $mail->attach($tempPath, [
                    'as' => $fileName,
                    'mime' => 'application/pdf',
                ]);
            }
        });
    
        // 5. Delete temporary file
        if (file_exists($tempPath)) {
            unlink($tempPath);
        }
    }

    

}
