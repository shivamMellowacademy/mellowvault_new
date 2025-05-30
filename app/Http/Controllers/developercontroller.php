<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Support\Facades\Hash;
use App\Models\DeveloperProjectDetail;
use App\Models\Developer;
use Illuminate\Support\Facades\Validator;
use App\Models\Premium;
use App\Models\developerPayments;
use App\Models\developerPremiumPrice;
use Carbon\Carbon;
use App\Services\UltraMsgService;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;


class developercontroller extends Controller
{
    private $razorpayId = "rzp_test_oGWqJW6LQBc9Gs";
    private $razorpayKey = "EDknjtGrhABUsDq0FGfnYDM3";
    
    protected $ultramsg;

    public function __construct(UltraMsgService $ultramsg)
    {
        $this->ultramsg = $ultramsg;
    }

    public function developer_data()
    { 
        $developer_id=Session::get('developer_login_id'); 
        return $developer_details = DB::table('developer_details_tb')->where('dev_id',$developer_id)->get();

        return $developer_project_details = DB::table('developer_project_details_tb')->where('developer_id',$developer_id)->get();
    }
    public function developer_registration()
    {   
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        return view('developer/developer_registration')->with($show);
    }
    public function submit_developer_registration(Request $request)
    {   
        request()->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'password' => 'required|min:5',
            'pro_id' => 'required',
        ]);
        
            $email=$request->post('email');
            
            $count = DB::table('developer_details_tb')->where('email',$email)->count();
    
            if($count == 0)
            {
                $data=array(
                    'pro_id'=>$request->post('pro_id'),
                    'name'=>$request->post('name'),
                    'last_name'=>$request->post('last_name'),
                    'phone'=>$request->post('phone'),
                    'email'=>$request->post('email'),
                    'password'=>Hash::make($request->post('password')),
                    'show_password'=>$request->post('password'),
                    'profile_complete'=>30,
                    'developer_status'=>"Inactive",
                    'date'=>date('y/m/d')
                );

                $result=DB::table('developer_details_tb')->insert($data);

                $email=$request->post('email'); 
        
                $details = DB::table('developer_details_tb')->where('email',$email)->get();
                $emails=array();
                foreach ($details as $key) 
                {
                    $emails[]= $key->email;
                    $email= $key->email;
                    $fname= $key->name;
                }

               $datas=array(
                    'email'=>$email,
                    'fname'=>$fname
                );

                if($result==true)
                {
                    session(['message' =>'success', 'errmsg' =>'Registration Complete']);

                        Mail::send('registration_mail', $datas, function($message) use ($emails) {
                        $message->to($emails)->subject('Mellow Elements');
                        $message->from('dev@mellowelements.in', 'Mellow Elements');
                    });
                    
                    // âœ… Send WhatsApp message
                    // $this->ultramsg->sendMessage(
                    //     '91' . $request->post('phone'),
                    //     "Hello {$fname}, welcome to Mellow Voult! ðŸ‘‹\n\nYour registration was successful. If you have any questions, we're here to help.\n\nâ€“ Team Mellow Voult"
                    // );

                     return view('developer/index');
                }
                else
                {
                    session(['message' =>'danger', 'errmsg'=>'Registration Not Complete']); 
                    return redirect()->back();
                }
            }
            else
            {
                session(['message' =>'danger', 'errmsg' =>'Email Address Already Exists.']);
                return redirect()->back();
            }
    }

    public function developer_admin()
    {   
        return view('developer/index');
    }

    // old funntion with usign md5 
    // public function login_verification(Request $request)
    // {
    //     request()->validate(['email' => 'required|email','password' => 'required']);
        
    //     $email=$request->post('email');
    //     $password=$request->post('password');
        
    //     $uses = DB::table('developer_details_tb')->where('email','=',$email)->where('password','=',md5($password))->count();
    //     dd($email,$password,$request->all(),$uses);
    //     if($uses > 0)
    //     {
    //         // $dev_login = DB::table('developer_details_tb')->where('email','=',$email)->first();

    //         // if($dev_login->login_status == 1){
    //             $deta= DB::table('developer_details_tb')->where('email','=',$email)->get();
    //             foreach($deta as $dd)
    //             {
    //                 $id=$dd->dev_id;
    //                 $email=$dd->email;
    //                 $name=$dd->name;
    //             }
    //             session(['developer_login_id' => $id,'developer_email_login' => $email,'developer_name_login' => $name]);
    //             session(['message' =>'success', 'errmsg' =>'Login Successfully.']);
    //             return redirect('developer_dashboard');
    //         // }else{
    //         //     session(['message' =>'danger','errmsg' =>'Your Account Is Not Activate Right Now.']);
    //         //     return redirect()->back();
    //         // } 
    //     }
    //     else
    //     {
    //         session(['message' =>'danger','errmsg' =>'Login Failed ? Username and Password Wrong....']);
    //         return redirect()->back();
    //     }                  
    // }

    // old funntion with usign Hash
    public function login_verification(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->post('email');
        $password = $request->post('password');

        // Get developer record by email
        $developer = DB::table('developer_details_tb')->where('email', $email)->first();

        if ($developer && Hash::check($password, $developer->password)) {
            // Successful login
            session([
                'developer_login_id' => $developer->dev_id,
                'developer_email_login' => $developer->email,
                'developer_name_login' => $developer->name,
                'message' => 'success',
                'errmsg' => 'Login Successfully.',
            ]);

            return redirect('developer_dashboard');
        } else {
            // Login failed
            session([
                'message' => 'danger',
                'errmsg' => 'Login Failed. Username or password is incorrect.',
            ]);

            return redirect()->back();
        }
    }

    public function developer_log()
    {
        Session::forget('developer_login_id');
        Session::forget('developer_email_login');
        Session::forget('developer_name_login');
        Session::flush();
        return redirect()->route('developer_admin');
    }

    
    public function developer_dashboard()
    {   
        $developer_id=Session::get('developer_login_id');



       $show['developer_details']=$this->developer_data();

        $show['total_require_docs'] = DB::table('require_docs_tb')->where('dev_id',$developer_id)->count();
        $show['total_short_message'] = DB::table('short_message_tb')->where('dev_id',$developer_id)->count();
        $show['total_sow'] = DB::table('sow_tb')->where('dev_id',$developer_id)->count();
        $show['total_work_space'] = DB::table('product_tb')->where('dev_id',$developer_id)->count();
        $show['work_space_details'] = DB::table('product_tb')->where('dev_id',$developer_id)->orderby('id','desc')->get();

        $show['developer_wallet_details'] = DB::table('developer_payment_transfer_tb')->where('dev_id',$developer_id)->get();

        return view('developer/developer_dashboard')->with($show);
    }

    public function developer_change_password()
    {
        $show['developer_details']=$this->developer_data();
        return view('developer/change_password')->with($show);
    }

    public function developer_update_password(Request $request)
    {   
       
        request()->validate(['con' => 'required','new' => 'required','old' => 'required']);
        
        $new=$request->post('new'); 
        $con=$request->post('con');
        $old=$request->post('old');
        if($new==$con)
        {   
            $use = DB::table('developer_details_tb')->where('password','=',md5($old))->count();
            if($use > 0)
            {           
                $data=array('password'=>md5($new),'show_password'=>$new);

                $developer_id=Session::get('developer_login_id'); 

                $update_result=DB::table('developer_details_tb')->where('dev_id',$developer_id)->update($data);
               
                
                if($update_result==true)
                {
                    session(['message' =>'success', 'errmsg' =>'Password Change Successfully.']);
                    return redirect()->back();
                }
                else
                {
                    session(['message' =>'danger', 'errmsg'=>'Password Change Failed. Due To Internal Server Error..']); 
                    return redirect()->back();
                }

            }
            else
            {
                session(['message' =>'danger', 'errmsg'=>'Old Password Does Not Matched. Please Try Again.....']); 
                return redirect()->back();              
            }
        }
        else
        {
            session(['message' =>'warning', 'errmsg'=>'New Password & Confrim Password Do Not Matched.']); 
            return redirect()->back();
        }     
    }
    
    public function premium_purchase_checkout()
    {   
        $show['developer_details']=$this->developer_data();
        $d_id=Session::get('developer_login_id'); 
        $show['developer_premium_price_table_details'] = DB::table('developer_premium_price_table')->orderby('id','asc')->get();
        return view('developer/premium_purchase_checkout')->with($show);
    }
    
    public function why_premium_purchase()
    {   
        $show['developer_details']=$this->developer_data();
        return view('developer/why_premium_purchase')->with($show);
    }
    
    public function premium_payment_initiate(Request $request)
    {    
       
        $show['developer_premium_price_table_details'] = DB::table('developer_premium_price_table')->orderby('id','asc')->get();
    	$d_id= Session::get('developer_login_id');
		$show['developer_details'] = DB::table('developer_details_tb')->orderby('dev_id','desc')->get();
		//$d_id= Session::get('developer_login_id');
		//echo $d_id; exit();
      
  		$fname = $request->post('name');
  		$lname = $request->post('last_name');
		$email = $request->post('email');
		$phone = $request->post('phone');
		$country = $request->post('country');
		$state = $request->post('state');
		$city = $request->post('city');
		$address_one = $request->post('address_one');
		$code = $request->post('code');
		$purpose = $request->post('purpose');
       
		session(['name' => $fname]);
		session(['last_name' => $lname]);
		session(['email' => $email]);
		session(['phone' => $phone]);
		session(['country' => $country]);
		session(['state' => $state]);
		session(['city' => $city]);
		session(['address_one' => $address_one]);
		session(['code' => $code]);
		session(['purpose' => $purpose]);
		
        //  $tprice= Session::get('total_price');
        //   $final=$tprice;		
		// // Generate random receipt id
        // $receiptId = Str::random(20);        
        // // Create an object of razorpay
        // $api = new Api($this->razorpayId, $this->razorpayKey);
        // // In razorpay you have to convert rupees into paise we multiply by 100
        // // Creating order
        // $order = $api->order->create(array(
		// 	'receipt' => $receiptId,
		// 	'amount' => (int) round($final * 100),
		// 	'currency' => 'INR'
		// 	)
        // );

        // request()->validate([
		// 			'phone' => 'required|digits:10',
		// 		]);
        // Return response on payment page
      
          $data = [
			'order_id' =>  $request->post('razorpay_payment_id'),
			'dev_id' => $d_id,
            'name' =>$fname,
            'last_name' =>$lname,             
			'email' => $email,
			'phone' =>$phone,
            'country' =>$country,
			'state' =>$state,
			'city' =>$city,
			'address_one' =>$address_one,
            'code' =>$code,
			'purpose' =>$purpose,
            'tprice' => ($request->post('amount')/100),
			'status' => 'Premium Member',
			'payment_status' => 'SUCCESS',
			'date' => Carbon::now(),
        ];
        // Let's checkout payment page is it working	
        DB::table('premium_order_tb')->insert( $data);
        // email notification
        $this->invoiceEmail(
            $email,
            $data['order_id'],
            $data['order_id'],
            $data['tprice']
        );

        return response()->json([
            'success' => true,
            'redirect_url' => route('developer_profile'), // or any other route
            'message' => 'Payment successful'
        ]);
    }
    
    public function premium_checkout(Request $request)
    {
        $u_id=Session::get('user_login_id'); 
    	$d_id= Session::get('developer_login_id');
		$show['developer_details'] = DB::table('developer_details_tb')->orderby('dev_id','desc')->get();

    	$fname = Session::get('name');
  		$lname = Session::get('last_name');
		$email = Session::get('email');
		$phone = Session::get('phone');
		$country = Session::get('country');
		$state = Session::get('state');
		$city = Session::get('city');
		$address_one = Session::get('address_one');
		$code = Session::get('code');
		$purpose = Session::get('purpose');
    	$tprice= Session::get('total_price');

    	$signatureStatus = $this->SignatureVerifys(
			$request->all()['rzp_signature'],
			$request->all()['rzp_paymentid'],
			$request->all()['rzp_orderid']
		);
		// If Signature status is true We will save the payment response in our database
		// In this tutorial we send the response to Success page if payment successfully made
		if($signatureStatus == true)
		{

			$d_id= Session::get('developer_login_id');
			$order_id = rand(0,9999);
			
			$pre = DB::table('developer_details_tb')->where('dev_id','=',$d_id)->get();     
			
				foreach($pre as $c)
				{
					$order_data=array(
					'order_id'=>$order_id,
					'dev_id'=>$d_id,
					'name'=>$fname,
					'last_name'=>$lname,
					'email'=>$email,
					'phone'=>$phone,
					'country'=>$country,
					'state'=>$state,
					'city'=>$city,
					'address_one'=>$address_one,
					'code'=>$code,
					'purpose'=>$purpose,
					'tprice'=>$tprice,
					'status'=>'Premium Member',				
					'payment_status'=>'SUCCESS',
					'date' => date("Y-m-d")				
					);				
					DB::table('premium_order_tb')->insert($order_data);

					$payment_data=array(
					'order_id'=>$order_id,
					'tprice'=>$tprice,
					'razorpay_payment_id'=>$request->all()['rzp_paymentid'],
					'date' => date("Y-m-d")
					);	

					DB::table('premium_payment_tb')->insert($payment_data);

					$email=Session::get('email');
					$details = DB::table('premium_order_tb')->where('email',$email)->get();
		            $emails=array();
		            foreach ($details as $key) 
		            {
		                $emails[]= $key->email;
		            }

		            $data = DB::table('premium_order_tb')->where('email',$email)->get();
		            foreach ($data as $k) 
		            {
		                $fname = $k->name;
		                $order_id = $k->order_id;
		                $url = route('contact');
		            }
		           	$datas=array(
		                'name'=>$fname,
		                'order_id'=>$order_id,
		                'link'=>$url
		            );

		           	$details=array(
		                'order_id'=>$order_id,
		            );

					Mail::send('premium_payment_mail', $datas, function($message) use ($emails) {
			            $message->to($emails)->subject('Mellow Element');
			            $message->from('info@mellowelements.in', 'Mellow Elements');   
			        });

			        Mail::send('admin_premium_information_mail', $details, function($message) {
			           $message->to('mellowtulika@gmail.com')->subject('Mellow Elements');
			           $message->from('info@mellowelements.in', 'Mellow Elements');  
			       	});

				}

				return redirect()->route('premium_thank_you');
				//return redirect('front/thank_you')->with($show);

			//echo 'rzp_signature'.$request->all()['rzp_signature'];
			//echo "<br>";
			//echo 'rzp_paymentid'.$request->all()['rzp_paymentid'];
			//echo "<br>";
			//echo 'rzp_orderid'.$request->all()['rzp_orderid'];
		}
		else
		{
			// You can create this page
			 session(['message' =>'danger', 'errmsg'=>'Payment Not Completed']); 
            return redirect()->back();
		}
	}
	
	
    public function invoiceEmail($toEmail, $order_id, $razorpay_payment_id, $tprice, $paymentType = 'Razorpay')
    {
        Log::info('invoiceEmail() started', [
            'email' => $toEmail,
            'order_id' => $order_id,
            'razorpay_payment_id' => $razorpay_payment_id,
            'tprice' => $tprice
        ]);
        $subject = 'Payment Successful - Thank You for Your Upgrading';
    
        // Prepare orderData for PDF and email
        $orderData = [
            'razorpay_payment_id' => $razorpay_payment_id,
            'mer_transaction_id' => $order_id,
            'amount_paid' => $tprice,
            'type' => $paymentType,
            'id' => $order_id, // used for PDF filename
        ];
    
        // 1. Generate PDF from Blade view
        $pdf = PDF::loadView('front.invoice.dev_invoice', ['orderData' => $orderData,'empData' => [
            'fname' => Session::get('name'),
            'lname' => Session::get('last_name'),
            'email' => Session::get('email'),
            'phone' => Session::get('phone'),
            'company_name' => Session::get('purpose'),
            'address' => Session::get('address_one'),
        ]]);
    
        // 2. Save the PDF to public/invoices
        $fileName = 'invoice_' . $order_id . '.pdf';
        $tempPath = public_path('invoices/' . $fileName);
    
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0775, true);
        }
    
        $pdf->save($tempPath);
    
        // 3. Compose the email HTML content
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
    
            // 4. Send Email with PDF attachment
           try {
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
        } catch (\Exception $e) {
            Log::error('Invoice email failed: ' . $e->getMessage());
        }
        
        
            // 5. Delete the file after sending
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }
        }

	private function SignatureVerifys($_signature,$_paymentId,$_orderId)
	{
		try
		{
			// Create an object of razorpay class
			$api = new Api($this->razorpayId, $this->razorpayKey);
			$attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
			$order  = $api->utility->verifyPaymentSignature($attributes);
			return true;
		}
		catch(\Exception $e)
		{
			// If Signature is not correct its give a excetption so we use try catch
			return false;
		}
	}
	
	public function premium_thank_you()
    {  
    	$d_id= Session::get('developer_login_id');
		$show['developer_details'] = DB::table('developer_details_tb')->orderby('dev_id','desc')->get();

		return view('developer/premium_thank_you')->with($show);
    }
    
    public function developer_interview_schedule_details()
    {
        $developer_id=Session::get('developer_login_id'); 

         $show['developer_details_interview_schedule'] = DB::table('developer_interview_schedule')->where('dev_id', $developer_id)->orderby('dev_id','desc')->get();
        
        return view('developer/developer_interview_schedule_details')->with($show);
    }

    public function developer_profile()
    {   
        
        $developer_id=Session::get('developer_login_id');
         


        $show['developer_details']=$this->developer_data();

        $show['developer_project_details']=$this->developer_data();

        $show['premium_profile_details'] = DB::table('premium_order_tb')->where('dev_id',$developer_id)->count();
        //dd($show['premium_profile_details']);
        
        $show['details'] = DB::table('developer_details_tb')
        ->select('higher_professional_tb.id as ids','higher_professional_tb.heading','developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.description','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.total_hours','developer_details_tb.rating','developer_details_tb.address','developer_details_tb.language','developer_details_tb.education','developer_details_tb.skills','developer_details_tb.completed_job','developer_details_tb.portfolio_image','developer_details_tb.resume','developer_details_tb.developer_status','developer_details_tb.show_password','developer_details_tb.available_start_date','developer_details_tb.available_end_date')
        ->join('higher_professional_tb','higher_professional_tb.id' , '=' , 'developer_details_tb.pro_id')
        ->where('developer_details_tb.dev_id',$developer_id)
        ->get();
        
        return view('developer/developer_profile')->with($show);
    }

    public function developer_profile_update_details()
    {   
        $show['developer_details']=$this->developer_data();
        return view('developer/update_profile')->with($show);
    }

    public function developer_profile_update(Request $request)
    {
        $developer_id=Session::get('developer_login_id'); 
       $data = DB::table('developer_details_tb')->where('dev_id',$developer_id)->get();
        foreach ($data as $d) {
            $total = $d->profile_complete;
            $profile_complete = $total;
           // if (empty($d->job)||empty($d->total_hours) && $total < 90) {
            if ($total <= 90) {
                $profile_complete = $total + 10;
        
                // Cap to 100
                if ($profile_complete > 100) {
                    $profile_complete = 100;
                }
            }
        }
    
        request()->validate(
        [
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'description' => 'required',
            'job' => 'required',
            'total_hours' => 'required',
            'perhr' => 'required',
            'rating' => 'required',
            'address' => 'required',
            'language' => 'required',
            'skills' => 'required',
            'completed_job' => 'required',
            'portfolio_image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
            // 'resume' => 'mimes:pdf|max:1000mb'
        ]);  

        // Handle portfolio image upload
        if ($request->hasFile('portfolio_image')) {
            $portfolioPath = public_path('upload/portfolio/');
            if (!file_exists($portfolioPath)) {
                mkdir($portfolioPath, 0755, true);
            }
        
            $portfolioFile = $request->file('portfolio_image');
            $portfolioFileName = time() . '_portfolio.' . $portfolioFile->getClientOriginalExtension();
            $portfolioFile->move($portfolioPath, $portfolioFileName);
        } else {
            $portfolioFileName = $request->input('old_portfolio_image');
        }
        
        // Handle resume upload
        if ($request->hasFile('resume')) {
            $resumePath = public_path('upload/resume/');
            if (!file_exists($resumePath)) {
                mkdir($resumePath, 0755, true);
            }
        
            $resumeFile = $request->file('resume');
            $resumeFileName = Str::random(10) . '_resume.' . $resumeFile->getClientOriginalExtension();
            $resumeFile->move($resumePath, $resumeFileName);
        } else {
            $resumeFileName = $request->input('old_resume');
        }

       $data = array(
        'name' => $request->post('name'),
        'last_name' => $request->post('last_name'),
        'phone' => $request->post('phone'),
        'email' => $request->post('email'),
        'description' => $request->post('description'),
        'job' => $request->post('job'),
        'total_hours' => $request->post('total_hours'),
        'perhr' => $request->post('perhr'),
        'rating' => $request->post('rating'),
        'address' => $request->post('address'),
        'language' => $request->post('language'),
        'skills' => $request->post('skills'),
        'completed_job' => $request->post('completed_job'),
        'portfolio_image' => $portfolioFileName, // Fixed variable
        'resume' => $resumeFileName,             // Fixed variable
        'profile_complete' => $profile_complete,
    );
        $dev_id=$request->post('update');   
        $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
            return response()->json([
                'status' => 200,
                'message' => 'Developer profile updated successfully!'
            ]);
    }

   public function developer_resource()
    {   
        $developer_id=Session::get('developer_login_id'); 

        $count = DB::table('developer_order_tb')->where('dev_id',$developer_id)->where('status',2)->orderby('id','desc')->count();

        if( $count != 0)
        {
            return redirect(env('URL'));
        }

        $show['resource_details'] = DB::table('developer_order_tb')->where('dev_id',$developer_id)->where('status',2)->orderby('id','desc')->get();


        return view('developer/developer_resource')->with($show);
    }

    public function developerPremium()
    {
        
        $developer_id=Session::get('developer_login_id'); 

        $show['resource_details'] = DB::table('developer_order_tb')->where('dev_id',$developer_id)->orderby('id','desc')->get();
        
        $taxRow = DB::table('developer_premium_price_table')->first();

        $show['tax'] = $taxRow ?? (object) ['tax' => 0];
        
        $show['premium'] = Premium::all();
        
        $show['prices'] = developerPremiumPrice::where('status',true)->get();
        
        $show['date'] = developerPayments::where('developer_id', Session::get('developer_login_id'))->orderBy('id', 'DESC')->first();
        
        $show['developer_id'] = $developer_id;

        return view('developer/developer_premium')->with($show);
    }
    
    // email notifiction for Premium Package prmium_dev_invoice.blade.php
    public function premiumPackageinvoiceEmail($toEmail = null, $order_id, $razorpay_payment_id, $tprice, $paymentType = 'Razorpay')
    {
        $developerId = Session::get('developer_login_id');
        $developer = DB::table('developer_details_tb')->where('dev_id', $developerId)->first();
    
        if (!$developer) {
            Log::warning("Developer not found for invoice email");
            return;
        }
    
        $toEmail = $developer->email;
    
        Log::info('invoiceEmail() started', [
            'email' => $toEmail,
            'order_id' => $order_id,
            'razorpay_payment_id' => $razorpay_payment_id,
            'tprice' => $tprice
        ]);
    
        $subject = 'Payment Successful - Thank You for Your Upgrading';
    
        $orderData = [
            'razorpay_payment_id' => $razorpay_payment_id,
            'mer_transaction_id' => $order_id,
            'amount_paid' => $tprice,
            'type' => $paymentType,
            'id' => $order_id,
        ];
    
        $pdf = PDF::loadView('front.invoice.prmium_dev_invoice', ['orderData' => $orderData, 'empData' => [
            'fname' => $developer->name,
            'lname' => $developer->last_name,
            'email' => $developer->email,
            'phone' => $developer->phone,
            'address' => $developer->address,
        ]]);
    
        $fileName = 'invoice_' . $order_id . '.pdf';
        $tempPath = public_path('invoices/' . $fileName);
    
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0775, true);
        }
    
        $pdf->save($tempPath);
    
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
                <p>Dear {$developer->name},</p>
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
    
        try {
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
        } catch (\Exception $e) {
            Log::error('Invoice email failed: ' . $e->getMessage());
        }
    
        if (file_exists($tempPath)) {
            unlink($tempPath);
        }
    }
    // end 

    public function developerPremiumPay(Request $request)
    {
        $developerPremiumPrice = DeveloperPremiumPrice::where('id', $request->razorpay_id)->first();
    
        if ($developerPremiumPrice) {
            // Determine expiry date based on the plan name
            if ($developerPremiumPrice->name === "one time")
                $expired = null;
            elseif ($developerPremiumPrice->name === "monthly")
                $expired = now()->addMonth();
            elseif ($developerPremiumPrice->name === "quarterly")
                $expired = now()->addMonths(3);
            elseif ($developerPremiumPrice->name === "yearly")
                $expired = now()->addYear();
            else
                $expired = null;
            
            developerPayments::create([
                'developer_id' => Session::get('developer_login_id'),
                'payment_id' => $request->razorpay_payment_id ?? '',
                'order_id' => $request->razorpay_order_id,
                'signature' => $request->razorpay_signature,
                'developer_premium_prices_id' => $request->razorpay_id ?? '',
                'expired' => $expired,
            ]);
            
            $this->premiumPackageinvoiceEmail(
                null, 
                $request->razorpay_order_id,
                $request->razorpay_payment_id,
                $developerPremiumPrice->price ?? 0, 
                'Razorpay'
            );
    
            return response()->json([
                'success' => true,
                'message' => 'Payment processed successfully'
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Invalid premium price ID'
        ], 400);
    }

    public function paymentSuccess(Request $request)
    {
        // Save the payment info if needed
        return response()->json(['success' => true, 'message' => 'Payment successful!']);
    }

    public function developer_require_docs($dev_id,$u_id)
    {   
        $show['require_details'] = DB::table('require_docs_tb')->where('dev_id',$dev_id)->where('u_id',$u_id)->orderby('id','desc')->get();

        return view('developer/developer_require_docs')->with($show);
    }

    public function developer_require_download($id)
    {   
        
        $details = DB::table('require_docs_tb')->where('id','=',$id)->first();
                   
        $file = $details->require_docs;
        $myFile = public_path('upload/require/'.$file);
        return response()->download($file); 
    }

    public function developer_short_message($dev_id,$u_id)
    {   
        $show['short_message_details'] = DB::table('short_message_tb')->where('dev_id',$dev_id)->where('u_id',$u_id)->orderby('id','desc')->get();

        return view('developer/developer_short_message')->with($show);
    }

    public function developer_short_message_reply(Request $request)
    {   
        
        request()->validate(
        [
            'client_id' => 'required',
            'short_id' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);
        
        $data=array(
            'client_id'=>$request->post('client_id'),
            'short_id'=>$request->post('short_id'),
            'subject'=>$request->post('subject'),
            'description'=>$request->post('description'),
        );

        $result=DB::table('short_message_reply_tb')->insert($data);

        $client_id = $request->post('client_id');

        $deta = DB::table('short_message_tb')->where('u_id',$client_id)->get();
        $emails=array();
        foreach ($deta as $key) 
        {
            $emails[]= $key->email;        
            $fname = $key->fname; 
            $subject = $key->subject; 
            $description = $key->description;            
        }

        $datas=array(
            'fname'=>$fname,
            'subject'=>$subject,
            'description'=>strip_tags($description),
        );

        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Reply Send Successfully.']);

           Mail::send('developer_reply_mail', $datas, function($message) use ($emails)
            {
                $message->to($emails)->subject('Get Mail From Client!');
                
                $message->from('dev@mellowelements.in', 'Mellow Elements');   
            });

            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Reply Send Failed.']); 
            return redirect()->back();
        }
    }


    public function developer_sow_docs($id,$u_id)
    {   

        $show['sow_details'] = DB::table('sow_tb')->where('dev_id',$id)->where('u_id',$u_id)->orderby('id','desc')->get();
        //dd($show['sow_details']);

        return view('developer/developer_sow_docs')->with($show);
    }

    public function developer_sow_download($id)
    {   
        
        $details = DB::table('sow_tb')->where('id','=',$id)->first();
                   
        $file = $details->sow_docs;
        $myFile = public_path('upload/sow/'.$file);
        return response()->download($file); 
    }

    public function developer_available_date_update_error()
    {
        session(['message' =>'danger', 'errmsg'=>'Activate Your Account.']); 
        return redirect()->back();
    }

    public function developer_available_date_update(Request $request)
    {
        request()->validate(
        [
            'available_start_date' => 'required',
            'available_end_date' => 'required',
        ]);  

        $data=array(
            'available_start_date'=>$request->post('available_start_date'),
            'available_end_date'=>$request->post('available_end_date'),
        );

        $dev_id=$request->post('update');       
        $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg'=>'Available Date Update.']); 

            return redirect()->route('developer_profile');
            
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Available Date Update Failed.']); 
            return redirect()->back();
        }
    }

    public function add_work_space_error()
    {
        session(['message' =>'danger', 'errmsg'=>'Activate Your Account.']); 
        return redirect()->back();

    }

    public function work_space()
    {
        $dev_id=Session::get('developer_login_id'); 

        $data['developer_details']=$this->developer_data();

        $data['product'] = DB::table('product_tb')->where('dev_id',$dev_id)->orderby('id','desc')->get();
        $data['details'] = DB::table('subcategory_tb')->orderby('id','desc')->get();
        $data['cat'] = DB::table('category_tb')->orderby('id','desc')->get();

        return view('developer/work_space')->with($data);

    }
    public function work_show(Request $request)
    {   
        $c_id = $request->post('c_id');

        $show = DB::table('subcategory_tb')->where('category_id', '=' , $c_id)->count();
       
       if($show > 0 )
       {
        $data = DB::table('subcategory_tb')->where('category_id', '=' , $c_id)->get();
        foreach ($data as $dd) {            
            $output='<option value="'.$dd->id.'">'.$dd->name.'</option>'; 
            echo $output; }
        }
        else
        {
            $output='<option value="0">No Any Data</option>'; 
            echo $output;
        }    
    }

    public function add_work_space(Request $request)
    {   
        $details = DB::table('subscribe_tb')->get();
        $emails=array();
        foreach ($details as $key) 
        {
            $emails[]= $key->email;
        }
        $dev_id=Session::get('developer_login_id'); 
        if($request->file('multiple_image') == ''){

                request()->validate(
                [
                    'subcategory_id' => 'required',
                    'c_id' => 'required',
                    'name' => 'required',
                    'price' => 'required',
                ]);

                if($request->file('image') == ''){
                   
                    $getimageName = null;
                }else{
                    $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
                    $path = public_path('upload/product/'.$getimageName);
                    $img = Image::make($request->file('image')->getRealPath())->save($path);
                }

                if($files=$request->file('source_code'))
                {
                    $new_name = rand().'.'.$request->source_code->getClientOriginalExtension();
                    $getsourcecode = $request->source_code->move(public_path('upload/source_code'),$new_name); 
                }else{
                    $getsourcecode = null;
                }

                if($files=$request->file('video'))
                {
                    $new_name = rand().'.'.$request->video->getClientOriginalExtension();
                    $getvideo = $request->video->move(public_path('upload/video'),$new_name); 
                }else{
                    $new_name = null;
                }

                if($files=$request->file('psd'))
                {
                    $new_psd = rand().'.'.$request->psd->getClientOriginalExtension();
                    $getpsd = $request->psd->move(public_path('upload/psd'),$new_psd); 
                }else{
                    $new_psd = null;
                }

                $data=array(
                    'subcategory_id'=>$request->post('subcategory_id'),
                    'c_id'=>$request->post('c_id'),
                    'dev_id'=>$dev_id,
                    'name'=>$request->post('name'),
                    'description'=>$request->post('description'),
                    'image'=>$getimageName,
                    'multiple_image'=>'null',
                    'pro_type'=>$request->post('pro_type'),
                    'price'=>$request->post('price'),
                    'tax'=>$request->post('tax'),
                    'pro_size'=>$request->post('pro_size'),
                    'additions'=>$request->post('additions'),
                    'overview'=>$request->post('overview'),
                    'link'=>$request->post('link'),
                    'link'=>$request->post('link'),
                    'resolution'=>$request->post('resolution'),
                    'source_code'=>$getsourcecode,
                    'video'=>$new_name,
                    'psd'=>$new_psd,
                );
                    
                $result=DB::table('product_tb')->insert($data);

                $pro = DB::table('product_tb')->get();
                foreach($pro as $b) {
                    $url = route('product_details',['id'=>''.$b->id.'']); 
                    $name = $b->name;
                    $description = $b->description;
                }
                
                $datas=array(
                    'name'=>$name,
                    'description'=>substr(strip_tags($description), 0,100),
                    'link'=>$url
                );

                $files = [
                        public_path('upload/product/'.$getimageName.'')
                ];

                if($result==true)
                {
                    session(['message' =>'success', 'errmsg' =>'Product Added Successfully...']);
                    Mail::send('mail', $datas, function($message) use ($emails , $files)
                {
                    $message->to($emails)->subject('Mellow Element');
                    foreach ($files as $file){
                        $message->attach($file); }
                    $message->from('dev@mellowelements.in', 'Mellow Elements');
                    
                });
                    return redirect()->back();
                }
                else
                {
                    session(['message' =>'danger', 'errmsg'=>'Product Added Failed.']); 
                    return redirect()->back();
                }
        }else{

                request()->validate(
                [
                    'subcategory_id' => 'required',
                    'c_id' => 'required',
                    'name' => 'required',
                    'price' => 'required',
                ]);

                $images=array();
                $img=array();
                if($files=$request->file('multiple_image'))
                {
                    $img=array();
                    foreach($files as $file)
                    {
                        $getimageName=rand(0,999999999).''.$file->getClientOriginalName();              
                        $path = public_path('upload/product/'.$getimageName);
                        Image::make($file)->save($path);   
                        $img[]=$getimageName;
                    }           
                    $multiple_image=implode(",",$img);          
                }  

                if($request->file('image') == ''){
                   
                    $getimageName = null;
                }else{
                    $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
                    $path = public_path('upload/product/'.$getimageName);
                    $img = Image::make($request->file('image')->getRealPath())->save($path);
                }


                if($files=$request->file('source_code'))
                {
                    $new_name = rand().'.'.$request->source_code->getClientOriginalExtension();
                    $getsourcecode = $request->source_code->move(public_path('upload/source_code'),$new_name); 
                }

                if($files=$request->file('video'))
                {
                    $new_name = rand().'.'.$request->video->getClientOriginalExtension();
                    $getvideo = $request->video->move(public_path('upload/video'),$new_name); 
                }else{
                    $new_name = null;
                }

                if($files=$request->file('psd'))
                {
                    $new_psd = rand().'.'.$request->psd->getClientOriginalExtension();
                    $getpsd = $request->psd->move(public_path('upload/psd'),$new_psd); 
                }else{
                    $new_psd = null;
                }

               
                $data=array(
                    'subcategory_id'=>$request->post('subcategory_id'),
                    'c_id'=>$request->post('c_id'),
                    'dev_id'=>$dev_id,
                    'name'=>$request->post('name'),
                    'description'=>$request->post('description'),
                    'image'=>$getimageName,
                    'multiple_image'=>$multiple_image,
                    'pro_type'=>$request->post('pro_type'),
                    'price'=>$request->post('price'),
                    'tax'=>$request->post('tax'),
                    'pro_size'=>$request->post('pro_size'),
                    'additions'=>$request->post('additions'),
                    'overview'=>$request->post('overview'),
                    'link'=>$request->post('link'),
                    'resolution'=>$request->post('resolution'),
                    'source_code'=>$getsourcecode,
                    'video'=>$new_name,
                    'psd'=>$new_psd,
                );

                $result=DB::table('product_tb')->insert($data);

                $pro = DB::table('product_tb')->get();
                foreach($pro as $b) {
                $url = route('product_details',['id'=>''.$b->id.'']); 
                $name = $b->name;
                $description = $b->description;
                }

                $datas=array(
                    'name'=>$name,
                    'description'=>substr(strip_tags($description), 0,100),
                    'link'=>$url
                );
                $files = [
                        public_path('upload/product/'.$getimageName.'')
                    ];
                if($result==true)
                {
                    session(['message' =>'success', 'errmsg' =>'Product Added Successfully...']);
                    Mail::send('mail', $datas, function($message) use ($emails , $files)
                {
                    $message->to($emails)->subject('Mellow Element');
                    foreach ($files as $file){
                        $message->attach($file); }
                    $message->from('dev@mellowelements.in', 'Mellow Elements');
                    
                });
                    return redirect()->back();
                }
                else
                {
                    session(['message' =>'danger', 'errmsg'=>'Product Added Failed.']); 
                    return redirect()->back();
                }
        }
    }

     public function work_space_updates($id)
    {  
       
        $data['product'] = DB::table('product_tb')->where('id',$id)->orderby('id','desc')->get();
        $data['details'] = DB::table('subcategory_tb')->orderby('id','desc')->get();
        $data['cat'] = DB::table('category_tb')->orderby('id','desc')->get(); 
        return view('developer/work_space_updates')->with($data);
    }
    public function work_space_details_updates(Request $request)
    {
    
        request()->validate(
        [
            'subcategory_id' => 'required',
            'c_id' => 'required',
            'name' => 'required',
            'price' => 'required',          
        ]);  
        $dev_id=Session::get('developer_login_id'); 
       if(!empty($files=$request->file('multiple_image')))
        {
            $img=array();
            foreach($files as $file)
            {
                $getimageName=rand(0,999999999).''.$file->getClientOriginalName();              
                $path = public_path('upload/product/'.$getimageName);
                Image::make($file)->save($path);   
                $img[]=$getimageName;
            }           
            $multiple_image=implode(",",$img);          
        }
        else
        {
            $multiple_image=$request->post('old_multiple_image');
        }
        if(!empty($files=$request->file('image')))
        {
            $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
            $path = public_path('upload/product/'.$getimageName);
            $img = Image::make($request->file('image')->getRealPath())->save($path);
        }
        else
        {
            $getimageName=$request->post('old_image');
        }


       if(!empty($files=$request->file('source_code')))
        {
            $new_name = rand().'.'.$request->source_code->getClientOriginalExtension();
            $getsourcecode = $request->source_code->move(public_path('upload/source_code'),$new_name); 
        }
        else
        {
            $getsourcecode=$request->post('old_source_code');
        }

        if(!empty($files=$request->file('video')))
        {
            $new_name = rand().'.'.$request->video->getClientOriginalExtension();
            $getvideo = $request->video->move(public_path('upload/video'),$new_name); 
        }
        else
        {
            $new_name=$request->post('old_video');
        }

        if(!empty($files=$request->file('psd')))
        {
            $new_psd = rand().'.'.$request->psd->getClientOriginalExtension();
            $getpsd = $request->psd->move(public_path('upload/psd'),$new_psd); 
        }
        else
        {
            $new_psd=$request->post('old_psd');
        }

        $data=array(
            'subcategory_id'=>$request->post('subcategory_id'),
            'c_id'=>$request->post('c_id'),
            'dev_id'=>$dev_id,
            'name'=>$request->post('name'),
            'description'=>$request->post('description'),
            'image'=>$getimageName,
            'multiple_image'=>$multiple_image,
            'pro_type'=>$request->post('pro_type'),
            'price'=>$request->post('price'),
            'tax'=>$request->post('tax'),
            'pro_size'=>$request->post('pro_size'),
            'additions'=>$request->post('additions'),
            'overview'=>$request->post('overview'),
            'link'=>$request->post('link'),
            'resolution'=>$request->post('resolution'),
            'source_code'=>$getsourcecode,
            'video'=>$new_name,
            'psd'=>$new_psd,
        );
        $id=$request->post('update');       
        $result=DB::table('product_tb')->where('id',$id)->update($data);
        if($result==true)
        {
           
            session(['message' =>'success', 'errmsg' =>'Product Details Update Successfully...']);
            return redirect()->route('work_space');
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Product Details Update Failed. Due To Internal Server Error..']); 
            return redirect()->back();
        }
    }
    public function delete_work_space($id)
    {
       
        $info_delete=DB::table('product_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'errmsg'=>'Product Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Product Details Delete Failed ? Due To Internal Server Error...']); 
            return redirect()->back();
        }
    } 

    public function developer_project()
    {
        $dev_id=Session::get('developer_login_id'); 

        
        $show['developer_project_Details']=DB::table('developer_project_details_tb')->where('developer_id',$dev_id)->get();
        return view('developer/developer_project')->with($show);
    }

    // by shankar 
    public function storeOrUpdateProjectDetails(Request $request)
    {
        $dev_id = Session::get('developer_login_id');

        // Validation rules
        $rules = [
            'project_link' => 'required|url',
            'screenshot_image' => $request->hasFile('screenshot_image') ? 'image|mimes:jpg,png,jpeg,gif|max:5120' : '',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle Image Upload
        $getscreenshotimage = $request->old_screenshot_image ?? null;

        if ($request->hasFile('screenshot_image')) {
            $getscreenshotimage = time() . '.' . $request->file('screenshot_image')->getClientOriginalExtension();
            $path = public_path('upload/screenshot/' . $getscreenshotimage);
            Image::make($request->file('screenshot_image')->getRealPath())->save($path);
        }

        // Save or Update
        $isUpdate = $request->has('update');

        $devProject = DeveloperProjectDetail::updateOrCreate(
            ['id' => $request->update ?? null],
            [
                'developer_id' => $dev_id,
                'project_link' => $request->project_link,
                'screenshot_image' => $getscreenshotimage,
            ]
        );

        // Profile completion logic (only for new insert)
        if (!$isUpdate) {
            $developer = Developer::find($dev_id);
            if ($developer) {
                $projectCount = $developer->projects()->count();
                if ($projectCount < 2) {
                    $developer->profile_complete += 10;
                    $developer->save();
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => $isUpdate 
                ? 'Developer Project Details Updated Successfully...' 
                : 'Developer Project Details Added Successfully...'
        ]);
    }

    public function delete_project_details($developer_id)
    {
        $project = DeveloperProjectDetail::find($developer_id);

        if ($project) {
            // Optional: delete the image file too
            if ($project->screenshot_image && file_exists(public_path('upload/screenshot/' . $project->screenshot_image))) {
                @unlink(public_path('upload/screenshot/' . $project->screenshot_image));
            }

            $project->delete();

            session()->flash('message', 'success');
            session()->flash('devProjecterrmsg', 'Developer Project Details Delete Successfully.');
        } else {
            session()->flash('message', 'danger');
            session()->flash('devProjecterrmsg', 'Developer Project Not Found.');
        }

        return redirect()->back();
    }

    public function developer_kyc()
    {
        $show['developer_details']=$this->developer_data();
        return view('developer/developer_kyc')->with($show);
    }

    public function add_developer_kyc(Request $request)
    {
        $dev_id=Session::get('developer_login_id');   

        $data = DB::table('developer_details_tb')->where('dev_id',$dev_id)->get();

        foreach ($data as $d) {
          $total = $d->profile_complete;
        }

        $profile_complete = $total + 30;

        request()->validate(
        [
            'national_id_name' => 'required',
            'national_id_image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
            'adharcard' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
            'pancard' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
            'signature' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
             'adhar_number' => [
                'required',
                'digits:12',
                Rule::unique('developer_details_tb', 'adhar_number')->ignore($request->developer_id, 'dev_id'),
            ],
            'pan_number' => [
                'required',
                'regex:/^[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}$/',
                Rule::unique('developer_details_tb', 'pan_number')->ignore($request->developer_id, 'dev_id'),
            ],
        ]);  

        
        $getimage = time().'.'.$request->image->getClientOriginalExtension();       
        $path = public_path('upload/developer/'.$getimage);
        $img = Image::make($request->file('image')->getRealPath())->save($path);
        
        $getnationalidimage = time().'.'.$request->national_id_image->getClientOriginalExtension();       
        $path = public_path('upload/national_image/'.$getnationalidimage);
        $img = Image::make($request->file('national_id_image')->getRealPath())->save($path);

        $getsignature = time().'.'.$request->signature->getClientOriginalExtension();       
        $path = public_path('upload/signature/'.$getsignature);
        $img = Image::make($request->file('signature')->getRealPath())->save($path);

        $getadharcard = time().'.'.$request->adharcard->getClientOriginalExtension();       
        $path = public_path('upload/adhar_card/'.$getadharcard);
        $img = Image::make($request->file('adharcard')->getRealPath())->save($path);

        $getpancard = time().'.'.$request->pancard->getClientOriginalExtension();       
        $path = public_path('upload/pan_card/'.$getpancard);
        $img = Image::make($request->file('pancard')->getRealPath())->save($path);

        $data=array(
            
           'national_id_name'=>$request->post('national_id_name'),
            'national_id_image'=>$getnationalidimage,
            'image'=>$getimage,
            'signature'=>$getsignature,
            'profile_complete'=>$profile_complete,
            'adharcard'=>$getadharcard,
            'pancard'=>$getpancard,
            'adhar_number'       => $request->post('adhar_number'),
            'pan_number'         => $request->post('pan_number'),
        );
       
       $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'devkycerrmsg' =>'KYC Details Add Successfully...']);
            return redirect()->back();            
        }
        else
        {
            session(['message' =>'danger', 'devkycerrmsg'=>'KYC Details Add Failed.']); 
            return redirect()->back();
        }

    }

    public function update_developer_kyc_details()
    {
        $show['developer_details']=$this->developer_data();
        return view('developer/update_developer_kyc_details')->with($show);
    }
    
    
    public function update_developer_kyc(Request $request)
    {
        $dev_id = Session::get('developer_login_id');

        $request->validate([
            'national_id_name' => 'required|string',
        
            'national_id_image' => $request->hasFile('national_id_image') || !$request->old_national_id_image
                ? 'required|mimes:jpeg,png,jpg,pdf|max:2048'
                : 'nullable',
        
            'image' => $request->hasFile('image') || !$request->old_image
                ? 'required|mimes:jpeg,png,jpg,pdf|max:2048'
                : 'nullable',
        
            'signature' => $request->hasFile('signature') || !$request->old_signature
                ? 'required|mimes:jpeg,png,jpg,pdf|max:2048'
                : 'nullable',
        
            'adharcard' => $request->hasFile('adharcard') || !$request->old_adharcard
                ? 'required|mimes:jpeg,png,jpg,pdf|max:2048'
                : 'nullable',
        
            'pancard' => $request->hasFile('pancard') || !$request->old_pancard
                ? 'required|mimes:jpeg,png,jpg,pdf|max:2048'
                : 'nullable',

            'adhar_number' => [
                'required',
                'digits:12',
                Rule::unique('developer_details_tb', 'adhar_number')->ignore($request->developer_id, 'dev_id'),
            ],
            'pan_number' => [
                'required',
                'regex:/^[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}$/',
                Rule::unique('developer_details_tb', 'pan_number')->ignore($request->developer_id, 'dev_id'),
            ],
        ]);
        

        $getimage = $request->file('image') 
            ? uploadFile($request->file('image'), 'developer', 'image') 
            : $request->post('old_image');

        $getnationalidimage = $request->file('national_id_image') 
            ? uploadFile($request->file('national_id_image'), 'national_image', 'nationalid') 
            : $request->post('old_national_id_image');

        $getsignature = $request->file('signature') 
            ? uploadFile($request->file('signature'), 'signature', 'signature') 
            : $request->post('old_signature');

        $getadharcard = $request->file('adharcard') 
            ? uploadFile($request->file('adharcard'), 'adhar_card', 'adharcard') 
            : $request->post('old_adharcard');

        $getpancard = $request->file('pancard') 
            ? uploadFile($request->file('pancard'), 'pan_card', 'pancard') 
            : $request->post('old_pancard');

        $data = [
            'national_id_name'   => $request->post('national_id_name'),
            'national_id_image'  => $getnationalidimage,
            'image'              => $getimage,
            'signature'          => $getsignature,
            'adharcard'          => $getadharcard,
            'pancard'            => $getpancard,
            'adhar_number'       => $request->post('adhar_number'),
            'pan_number'         => $request->post('pan_number'),
        ];

        $result = DB::table('developer_details_tb')->where('dev_id', $dev_id)->update($data);

        if ($result) {
            session(['message' => 'success', 'devkycerrmsg' => 'KYC Details Update Successfully...']);
            return redirect()->route('developer_kyc');
        } else {
            session(['message' => 'danger', 'devkycerrmsg' => 'KYC Details Update Failed.']);
            return redirect()->back();
        }
    }



    public function bank_details()
    {
        $show['developer_details']=$this->developer_data();
        return view('developer/bank_details')->with($show);
    }

    public function add_bank_details(Request $request)
    {
        $dev_id=Session::get('developer_login_id');   

        $data = DB::table('developer_details_tb')->where('dev_id',$dev_id)->get();

        foreach ($data as $d) {
          $total = $d->profile_complete;
        }

        $profile_complete = $total + 10;

        request()->validate(
        [
            'bank_name' => 'required',
            'branch_name' => 'required',
            'acct_name' => 'required',
            'account_number' => 'required',
            'ifc_code' => 'required',
            'micr_number' => 'required',
            'account_Type' => 'required',
            'passbook' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
           
        ]);  

        
        $getpassbook = time().'.'.$request->passbook->getClientOriginalExtension();       
        $path = public_path('upload/passbook/'.$getpassbook);
        $img = Image::make($request->file('passbook')->getRealPath())->save($path);
        
        $data=array(
            'bank_name'=>$request->post('bank_name'),
            'branch_name'=>$request->post('branch_name'),
            'acct_name'=>$request->post('acct_name'),
            'account_number'=>$request->post('account_number'),
            'ifc_code'=>$request->post('ifc_code'),
            'micr_number'=>$request->post('micr_number'),
            'account_Type'=>$request->post('account_Type'),
            'profile_complete'=>$profile_complete,
            'passbook'=>$getpassbook,
        );
       
       $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'bankerrmsg' =>'Bank Details Add Successfully...']);
            return redirect()->back();            
        }
        else
        {
            session(['message' =>'danger', 'bankerrmsg'=>'Bank Details Add Failed.']); 
            return redirect()->back();
        }

    }

    public function update_developer_bank_details()
    {
        $show['developer_details']=$this->developer_data();
        return view('developer/update_developer_bank_details')->with($show);
    }


    public function update_developer_bank(Request $request)
    {
        $dev_id=Session::get('developer_login_id'); 
        
        request()->validate(
        [
            'bank_name' => 'required',
            'branch_name' => 'required',
            'acct_name' => 'required',
            'account_number' => 'required',
            'ifc_code' => 'required',
            'micr_number' => 'required',
            'account_Type' => 'required',
            'passbook' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);   

        if(!empty($files=$request->file('passbook')))
        {
            $getpassbook = time().'.'.$request->passbook->getClientOriginalExtension();       
            $path = public_path('upload/passbook/'.$getpassbook);
            $img = Image::make($request->file('passbook')->getRealPath())->save($path);
        }
        else
        {
            $getpassbook=$request->post('old_passbook');
        }

        $data=array(
            'bank_name'=>$request->post('bank_name'),
            'branch_name'=>$request->post('branch_name'),
            'acct_name'=>$request->post('acct_name'),
            'account_number'=>$request->post('account_number'),
            'ifc_code'=>$request->post('ifc_code'),
            'micr_number'=>$request->post('micr_number'),
            'account_Type'=>$request->post('account_Type'),
            'passbook'=>$getpassbook,
        );
       
       $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'devkycerrmsg' =>'Bank Details Update Successfully...']);
            return redirect()->route('developer_kyc');
        }
        else
        {
            session(['message' =>'danger', 'devkycerrmsg'=>'Bank Details Update Failed.']); 
            return redirect()->back();
        }
    }

    public function profile_education_update_Details($dev_id)
    {
        $show['developer_education_details']=$this->developer_data();
        return view('developer/education_profile_details')->with($show);
    }

    public function education_profile_update(Request $request)
    {
        $dev_id=Session::get('developer_login_id'); 
        $data = DB::table('developer_details_tb')->where('dev_id',$dev_id)->get();

        foreach ($data as $d) {
          $total = $d->profile_complete;
        }

        $profile_complete = $total + 10;

        $develoepr_education = DB::table('developer_details_tb')->where('dev_id',$dev_id)->first();

        if($develoepr_education->education == '' && $develoepr_education->clg_name == '' && $develoepr_education->degree == '' && $develoepr_education->percentage == '' && $develoepr_education->passing_year == '')
        {
        
            request()->validate(
            [            
                'education' => 'required',
                'clg_name' => 'required',
                'degree' => 'required',
                'percentage' => 'required',
                'passing_year' => 'required',
            ]);  

            $array_education = $request->post('education');
            $education = implode(',', $array_education);

            $array_clg_name = $request->post('clg_name');
            $clg_name = implode(',', $array_clg_name);

            $array_degree = $request->post('degree');
            $degree = implode(',', $array_degree);

            $array_percentage = $request->post('percentage');
            $percentage = implode(',', $array_percentage);

            $array_passing_year = $request->post('passing_year');
            $passing_year = implode(',', $array_passing_year);

            $data=array(
                
                'education'=>$education,
                'clg_name'=>$clg_name,
                'degree'=>$degree,
                'percentage'=>$percentage,
                'passing_year'=>$passing_year,
                'profile_complete'=>$profile_complete,
            );

            $dev_id=$request->post('dev_id');   

            $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
        }else
        {
            request()->validate(
            [            
                'education' => 'required',
                'clg_name' => 'required',
                'degree' => 'required',
                'percentage' => 'required',
                
            ]);  

            $array_education = $request->post('education');
            $education = implode(',', $array_education);

            $array_clg_name = $request->post('clg_name');
            $clg_name = implode(',', $array_clg_name);

            $array_degree = $request->post('degree');
            $degree = implode(',', $array_degree);

            $array_percentage = $request->post('percentage');
            $percentage = implode(',', $array_percentage);

            $array_passing_year = $request->post('passing_year');
            $passing_year = implode(',', $array_passing_year);

            $data=array(
                
                'education'=>$education,
                'clg_name'=>$clg_name,
                'degree'=>$degree,
                'percentage'=>$percentage,
                'passing_year'=>$passing_year,
            );

            $dev_id=$request->post('dev_id');   

            $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
        }
        
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Education Details Update Successfully...']);
           return redirect()->route('developer_profile');
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Education Details Update Failed.']); 
            return redirect()->back();
        }
    }

    public function all_transaction_details()
    { 
        $developer_id=Session::get('developer_login_id'); 

        $show['wallet_details']= DB::table('developer_payment_transfer_tb')->where('dev_id',$developer_id)->orderby('id','desc')->get();
       
        $show['product_details'] = DB::table('product_tb')->get();

        return view('developer/all_transaction')->with($show);
    }

    public function transaction_product_details($p_id)
    { 
        $developer_id=Session::get('developer_login_id'); 

        $show['product_details'] = DB::table('product_tb')->where('id',$p_id)->get();

        return view('developer/transaction_product_details')->with($show);
    }

    public function developer_milestone_details($sow_id)
    {   
        $developer_id=Session::get('developer_login_id');
        $show['developer_milestone'] = DB::table('milestone_tb')->where('sow_id',$sow_id)->orderby('id','desc')->get();
        $show['developer_price_details'] = DB::table('developer_details_tb')->where('dev_id',$developer_id)->get();

        return view('developer/developer_milestone_details')->with($show);
    }

    public function developer_milestone_accept($sow_value,$id)
    {
        $data=array(
            'status'=>$sow_value,
        );
    
        $info_delete=DB::table('milestone_tb')->where('id',$id)->update($data);
        if($info_delete==true)
        {
            
            session(['message' =>'success', 'projectcomplitionerrmsg'=>'Milestone Accept.']); 
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    }

    public function developer_milestone_reject($sow_value,$id,Request $request)
    {
        $data=array(
            'status'=>$sow_value,
            'milestone_reject'=>$request->post('milestone_reject'),
        );
    
        $info_delete=DB::table('milestone_tb')->where('id',$id)->update($data);
        if($info_delete==true)
        {
            
            session(['message' =>'success', 'projectcomplitionerrmsg'=>'Milestone Reject.']); 
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    } 

    // public function milestone_status(Request $request)
    // {   
    //     $status = $request->post('status');
    //     $id = $request->post('id');

    //     $data=array(
    //         'status'=>$status,
    //     );            
        
    //     $result = DB::table('milestone_tb')->where('id',$id)->update($data);

    //     if($result == true){
    //         echo "Status Update!!";
    //     }else{
    //         echo "Status Not Update!!";
    //     } 
    // }

    public function developer_milestone_pdf_download($id)
    {   
        
        $details = DB::table('milestone_tb')->where('id','=',$id)->first();
                   
        $file = $details->milestone_pdf;
        $myFile = public_path('upload/milestone/'.$file);
        return response()->download($file); 
    }


    public function submit_complition_request(Request $request)
    {   
        $milestone_id = $request->post('milestone_id');
        request()->validate(
        [
            'message' => 'required',
        ]);

        $images=array();
        $img=array();
        if($files=$request->file('project_screenshot'))
        {
            $img=array();
            foreach($files as $file)
            {
                $getprojectscreenshot=rand(0,999999999).''.$file->getClientOriginalName();              
                $path = public_path('upload/project_screenshot/'.$getprojectscreenshot);
                Image::make($file)->save($path);   
                $img[]=$getprojectscreenshot;
            }           
            $project_screenshot=implode(",",$img);          
        } else{
            $project_screenshot= '';
        }
       
        $data=array(
            'milestone_id'=>$request->post('milestone_id'),
            'message'=>$request->post('message'),
            'project_screenshot'=>$project_screenshot,
            'date'=>date('y/m/d')
        );

        $result=DB::table('project_complition_tb')->insert($data);

        

        $details = DB::table('milestone_tb')->where('id','=',$milestone_id)->first();

        if( $details->completion_status == '2'){

            $screenData=array(
                'completion_status'=>'0'
            );

            $result=DB::table('milestone_tb')->where('id','=',$milestone_id)->update($screenData);
        }


        if($result==true)
        {
            session(['message' =>'success', 'projectcomplitionerrmsg' =>'Project Details Send Successfully...']);
           
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'projectcomplitionerrmsg'=>'Project Details Send Failed.']); 
            return redirect()->back();
        }
    }


     public function sow_approve($id, $sow_value)
    {
        $milestone_approve = DB::table('sow_tb')->where('id',$id)->first();

        if( $sow_value == 1){

            $data=array(
                'sow_status'=>1,
            );
        
            $info_delete=DB::table('sow_tb')->where('id',$id)->update($data);
            if($info_delete==true)
            {
            
                session(['message' =>'success', 'errmsg'=>'SOW Accept.']); 
                return redirect()->back();
            }
            else
            {
                return redirect()->back();
            }
        }elseif( $sow_value == 2 ){
            $data=array(
                'sow_status'=>2,
            );
            $info_delete=DB::table('sow_tb')->where('id',$id)->update($data);
             if($info_delete==true)
            {
            
                session(['message' =>'success', 'errmsg'=>'SOW Reject.']); 
                return redirect()->back();
            }
            else
            {
                
                return redirect()->back();
            }
        }
    } 

    public function developer_milestone_project_details($sow_id)
    {   
        $show['milestone_project'] = DB::table('project_details_tb')->where('sow_id',$sow_id)->get();
        return view('developer/developer_milestone_project_details')->with($show);
    }

    public function wallet_details()
    {   
        $developer_id=Session::get('developer_login_id'); 
        // $show['developer_wallet_project'] = DB::table('project_details_tb')->where('dev_id',$developer_id)->get();
        // $show['developer_wallet_milestone'] = DB::table('milestone_tb')->get();

        $show['developer_wallet_milestone'] = DB::table('milestone_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.perhr','developer_details_tb.pro_id','milestone_tb.milestone_name','milestone_tb.days','milestone_tb.dev_id','milestone_tb.dev_id','milestone_tb.id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'milestone_tb.dev_id')
        ->where('developer_details_tb.dev_id',$developer_id)
        ->get();

        $show['commission_details'] = DB::table('commission_tb')->get();

        return view('developer/wallet_details')->with($show);
    }

    public function developer_create_milestone($u_id,$dev_id)

    {   
        $show['sow_details'] = DB::table('sow_tb')->where('u_id',$u_id)->where('dev_id',$dev_id)->where('sow_status',1)->get();
        

        return view('developer/create_milestone')->with($show);
    }

    public function developer_submit_milestone(Request $request)
    {   
        $sow_id = $request->post('sow_id');

        $developer_sow_details = DB::table('sow_tb')->where('id',$sow_id)->first();

        $dev_id = $developer_sow_details->dev_id;
        
        request()->validate(
        [
            'milestone_name' => 'required',
            'work' => 'required',
            'days' => 'required',
            'milestone_pdf' => ['required', 'mimes:pdf','max:1000mb']
        ]);

        if($files=$request->file('milestone_pdf'))
            {
                $new_name = rand().'.'.$request->milestone_pdf->getClientOriginalExtension();
                $getmilestonepdf = $request->milestone_pdf->move(public_path('upload/milestone'),$new_name); 
            }

        $data=array(
            'dev_id'=>$dev_id,
            'sow_id'=>$request->post('sow_id'),
            'milestone_name'=>$request->post('milestone_name'),
            'work'=>$request->post('work'),
            'days'=>$request->post('days'),
            'milestone_pdf'=>$getmilestonepdf,
            'status'=>'Null',
            'date'=>date('y/m/d')
        );

        $result=DB::table('milestone_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'success', 'milestoneerrmsg' =>'Milestone Added Successfully...']);
            return redirect()->route('developer_milestone_details',['sow_id'=>$sow_id]);
        }
        else
        {
            session(['message' =>'danger', 'milestoneerrmsg'=>'Milestone Added Failed.']); 
            return redirect()->back();
        }
    }

    public function developer_update_milestone(Request $request)
    {
        $login_id=Session::get('client_login_id'); 
        request()->validate(
        [
            'milestone_name' => 'required',
            'work' => 'required',
            'days' => 'required',
        ]);

        if(!empty($files=$request->file('milestone_pdf')))
        {
            $new_name = rand().'.'.$request->milestone_pdf->getClientOriginalExtension();
            $getmilestonepdf = $request->milestone_pdf->move(public_path('upload/milestone'),$new_name);             
        }
        else
        {
            $getmilestonepdf=$request->post('old_milestone_pdf');
        }

        $data=array(
            'sow_id'=>$request->post('sow_id'),
            'milestone_name'=>$request->post('milestone_name'),
            'work'=>$request->post('work'),
            'days'=>$request->post('days'),
            'milestone_pdf'=>$getmilestonepdf,
            'status'=>'Null',
            'date'=>date('y/m/d')
        );

        $id=$request->post('update');       
        $result=DB::table('milestone_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'milestoneerrmsg' =>'Milestone Details Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'milestoneerrmsg'=>'Milestone Details Update Failed.']); 
            return redirect()->back();
        }
    }
    
    public function developer_delete_milestone($id)
    {
        $info_delete=DB::table('milestone_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'milestoneerrmsg'=>'Milestone Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'milestoneerrmsg'=>'Milestone Details Delete Failed.']); 
            return redirect()->back();
        }
    } 

    public function withdraw(Request $request,$milestone_id)
    {        
        $developer_id=Session::get('developer_login_id'); 
        
        $show['developer_wallet_milestone'] = DB::table('milestone_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.perhr','developer_details_tb.pro_id','milestone_tb.milestone_name','milestone_tb.days','milestone_tb.dev_id','milestone_tb.id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'milestone_tb.dev_id')
        ->where('developer_details_tb.dev_id',$developer_id)
        ->get();

        // $show['commission_details'] = DB::table('commission_tb')->get();

        $tprice= 1000;
                
       $final=$tprice;   
        // Generate random receipt id
        $receiptId = Str::random(20);        
        // Create an object of razorpay
        $api = new Api($this->razorpayId, $this->razorpayKey);
        // In razorpay you have to convert rupees into paise we multiply by 100
        // Creating order
        $order = $api->order->create(array(
            'receipt' => $receiptId,
            'amount' => $final * 100,
            'currency' => 'INR'
            )
        );
       
        // Return response on payment page
        $response = [
            'orderId' => $order['id'],
            'razorpayId' => $this->razorpayId,
            'currency' => 'INR',
            'amount' => $final,
            'mode'=> 'NEFT',
            'account_number'=> '7878780080316316',           
            'purpose' => 'refund',
            'description' => 'Buy Plan Payment',
        ];

          // Let's checkout payment page is it working    
        return view('developer/developer_withdraw_payment',compact('response'))->with($show);
    }

    private function SignatureVerify($_signature,$_paymentId,$_orderId)
    {
        try
        {
            // Create an object of razorpay class
            $api = new Api($this->razorpayId, $this->razorpayKey);
            $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            return true;
        }
        catch(\Exception $e)
        {
            // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }
    
}
