<!DOCTYPE html>
<html>
<head>
    <title>Salary Payment Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eaeaea;
            margin-bottom: 25px;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 0 15px;
        }
        .payment-details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
            font-size: 0.9em;
            color: #777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .pay-button {
            display: inline-block;
            background-color: #00264d;
            color: white !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .payment-actions {
            text-align: center;
            margin: 25px 0;
        }

        .payment-details {
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .copy-link {
            display: flex;
            margin-top: 10px;
        }
        .copy-link input {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
        }
        .copy-link button {
            background: #00264d;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="logo">
        <h2>Salary Payment Confirmation</h2>
    </div>
    
    <div class="content">
        <p>Dear Client,</p>
        
        <p>We have processed salary payments for your developers. Below are the details:</p>
        
        <div class="payment-details">
            <h3>Payment Summary</h3>
            <table>
                <thead>
                    <tr>
                        <th>Developer Name</th>
                        <th>Email</th>
                        <th>Amount (INR)</th>
                        <th>Tax (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['developers'] as $developer)
                    <tr>
                        <td>
                            <strong>{{ $developer->developer_name }}</strong>
                            <div class="developer-meta">
                                <small>Period: {{ $developer->payment_month }}/{{ $developer->payment_year }}</small>
                            </div>
                        </td>
                        <td>{{ $developer->developer_email }}</td>
                        <td>{{ number_format($developer->payment_amount, 2) }}</td>
                        <td>{{ number_format($developer->payment_tax, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right; font-weight: bold;">Subtotal:</td>
                        <td style="font-weight: bold;">₹{{ number_format($data['amount'], 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right; font-weight: bold;">Tax ({{ $data['taxRate'] }}%):</td>
                        <td style="font-weight: bold;">₹{{ number_format($data['tax'], 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right; font-weight: bold; border-top: 1px solid #333;">Total Due:</td>
                        <td style="font-weight: bold; border-top: 1px solid #333;">₹{{ number_format($data['amount'] + $data['tax'], 2) }}</td>
                    </tr>
                </tfoot>
            </table>
            
            <p><strong>Payment Date:</strong> {{ now()->format('F j, Y') }}</p>
        </div>
        
       <div class="payment-actions">
            <!-- Pay Now Button -->
            <a href="{{ route('pay.salary.payment', ['id' => $developer->u_id]) }}" 
            class="pay-button"
            style="display: inline-flex; align-items: center; gap: 8px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="margin-right: 8px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                Pay Now
            </a>
        </div>

        
        <p>Please find attached the payment receipts for your records.</p>
        
        <p>If you have any questions about this payment, please contact our support team.</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        <p>{{ config('app.company_address') }}</p>
    </div>

    <script>
        function copyPaymentLink() {
            const copyText = document.querySelector(".copy-link input");
            copyText.select();
            document.execCommand("copy");
            alert("Payment link copied to clipboard!");
        }
    </script>
</body>
</html>