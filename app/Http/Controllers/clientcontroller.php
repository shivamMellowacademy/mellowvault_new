<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Validation\Rule;
use Image;
use Mail;
use App\Models\DeveloperOrder;
use App\Models\Employer;
use App\Models\EmployerBankDetail;
use App\Models\EmployerKyc;

class clientcontroller extends Controller
{
    private $razorpayId = "rzp_test_oGWqJW6LQBc9Gs";
    private $razorpayKey = "EDknjtGrhABUsDq0FGfnYDM3";

    public function client_index()
    {   
        return view('client/client_index');
    }

     public function client_login(Request $request)
    {
        request()->validate(['email' => 'required|email','password' => 'required']);
        
        $email=$request->post('email');
        $password=$request->post('password');
        $uses = DB::table('user_login')->where('email','=',$email)->where('password','=',md5($password))->count();
        if($uses > 0)
        {
            $deta= DB::table('user_login')->where('email','=',$email)->get();
            foreach($deta as $dd)
            {
                $id=$dd->id;
                $email=$dd->email;
                $fname=$dd->fname;
            }
            session(['client_login_id' => $id,'client_email_login' => $email,'client_name_login' => $fname]);
            session(['message' =>'success', 'errmsg' =>'Login Successfully.']);
            return redirect('client_dashboard');
        }
        else
        {
            session(['message' =>'danger','errmsg' =>'Login Failed ? Username and Password Wrong....']);
            return redirect()->back();
        }                   
    }

    public function client_logout()
    {
        Session::forget('client_login_id');
        Session::forget('client_email_login');
        Session::forget('client_name_login');
        Session::flush();
        return redirect()->route('client_index');
    }

    

    public function client_dashboard()
    {   
        return view('client/client_dashboard');
    }

    public function client_profile()
    {   
        

        $login_id=Session::get('client_login_id'); 

        $show['client_profile_details'] = DB::table('user_login')->where('id',$login_id)->get();
        return view('client/client_profile')->with($show);
    }

     public function client_profile_update(Request $request)
    {
       
        request()->validate(
        [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'user_name' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
            
        ]);  


        if(!empty($files=$request->file('image')))
        {
            $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
            $path = public_path('upload/profile_image/'.$getimageName);
            $img = Image::make($request->file('image')->getRealPath())->save($path);
        }
        else
        {
            $getimageName=$request->post('old_image');
        }

        $data=array(
            
            'fname'=>$request->post('fname'),
            'lname'=>$request->post('lname'),
            'phone'=>$request->post('phone'),
            'email'=>$request->post('email'),
            'user_name'=>$request->post('user_name'),
            'image'=>$getimageName,
        );
        $id=$request->post('update');       
        $result=DB::table('user_login')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Profile Details Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Profile Details Update Failed.']); 
            return redirect()->back();
        }
    }

    public function client_change_password()
    {
        
        return view('client/client_change_password');
    }

    public function client_update_password(Request $request)
    {   
       
        request()->validate(['con' => 'required','new' => 'required','old' => 'required']);
        
        $new=$request->post('new'); 
        $con=$request->post('con');
        $old=$request->post('old');
        if($new==$con)
        {   
            $use = DB::table('user_login')->where('password','=',md5($old))->count();
            if($use > 0)
            {           
                $data=array('password'=>md5($new),'show_password'=>$new);

                $id=Session::get('client_login_id'); 

                $update_result=DB::table('user_login')->where('id',$id)->update($data);
               
                
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


    public function client_resource()
    {   
        $login_id=Session::get('client_login_id'); 

        $show['client_resource_details'] = DB::table('developer_order_tb')
        ->select('developer_details_tb.name','developer_details_tb.dev_id as devs_id','developer_details_tb.last_name','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.developer_status','developer_order_tb.interviewlink','developer_order_tb.schinterviewdatetime','developer_order_tb.dev_id','developer_order_tb.u_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->orderBy('dev_id', 'DESC')
        ->where('developer_order_tb.u_id',$login_id)
        
        ->get();

        

        return view('client/client_resource')->with($show);
    }
    
    public function client_ongoing_resource()
    {   
        $login_id=Session::get('client_login_id'); 

        $show['client_ongoing_resource_details'] = DB::table('developer_order_tb')
        ->select('developer_details_tb.name','developer_details_tb.dev_id as devs_id','developer_details_tb.last_name','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.developer_status','developer_order_tb.dev_id','developer_order_tb.u_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id',$login_id)
        ->where('developer_details_tb.developer_status','Booked')
        ->get();

        

        return view('client/client_ongoing_resource')->with($show);
    }
    
    public function client_completed_resource()
    {   
        $login_id=Session::get('client_login_id'); 

        $show['client_completed_resource_details'] = DB::table('developer_order_tb')
        ->select('developer_details_tb.name','developer_details_tb.dev_id as devs_id','developer_details_tb.last_name','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.developer_status','developer_order_tb.dev_id','developer_order_tb.u_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id',$login_id)
        ->where('developer_order_tb.payment_status','SUCCESS')
        ->get();

        

        return view('client/client_completed_resource')->with($show);
    }
    
    public function hiredDevelopersList()
    {
        $login_id = session('client_login_id');
        $employer = Employer::find($login_id);
        $hiredDevelopersData = DeveloperOrder::with('developer')
            ->where('u_id', $login_id)
            ->get()
            ->pluck('developer')
            ->unique('dev_id');
        return view('client.hired_developers_list', compact('hiredDevelopersData'));
    }

    public function client_require_docs($ids,$u_id)
    {   
        $show['client_require_docs_details'] = DB::table('require_docs_tb')->where('dev_id',$ids)->where('u_id',$u_id)->orderby('id','desc')->get();
        return view('client/client_require_docs')->with($show);
    }

    public function client_require_download($id)
    {   
        
        $details = DB::table('require_docs_tb')->where('id','=',$id)->first();
                   
        $file = $details->require_docs;
        $myFile = public_path('upload/require/'.$file);
        return response()->download($file); 

    }

    public function client_short_message($id,$u_id)
    {   
        $login_id=Session::get('client_login_id'); 

        $show['client_short_message_details'] = DB::table('short_message_tb')->where('dev_id',$id)->where('u_id',$u_id)->orderby('id','desc')->get();
        return view('client/client_short_message')->with($show);
    }

    public function client_short_message_reply($id)
    {   
        $login_id=Session::get('client_login_id'); 

        $show['short_message_reply_details'] = DB::table('short_message_reply_tb')->where('short_id',$id)->orderby('id','desc')->get();
        return view('client/short_message_reply')->with($show);
    }

    public function client_sow($id,$u_id)
    {   
        $login_id=Session::get('client_login_id'); 

        $show['client_sow_details'] = DB::table('sow_tb')->where('dev_id',$id)->where('u_id',$u_id)->orderby('id','desc')->get();
        return view('client/client_sow')->with($show);
    }

    public function client_sow_download($id)
    {   
        $details = DB::table('sow_tb')->where('id','=',$id)->first();
                   
        $file = $details->sow_docs;
        $myFile = public_path('upload/sow/'.$file);
        return response()->download($file); 
    }

    public function create_milestone(Request $request)
    {   
       $login_id=Session::get('client_login_id'); 

        request()->validate(
        [
            'project_name' => 'required',
            'project_price' => 'required',
            'project_duration' => 'required',
        ]);

        $data=array(
            'u_id'=>$login_id,
            'sow_id'=>$request->post('sow_id'),
            'dev_id'=>$request->post('dev_id'),
            'project_name'=>$request->post('project_name'),
            'project_price'=>$request->post('project_price'),
            'project_duration'=>$request->post('project_duration'),
            'date'=>date('y/m/d')
        );

        $result=DB::table('project_details_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'success', 'require_docs_errmsg' =>'Milestone Created Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'require_docs_errmsg'=>'Milestone Created Failed.']); 
            return redirect()->back();
        }
    }


    public function milestone_project_details($sow_id)
    {   
         
        $show['milestone_project'] = DB::table('project_details_tb')->where('sow_id',$sow_id)->get();
        return view('client/milestone_project_details')->with($show);
    }

    public function milestone($u_id,$dev_id)
    {   
        

        // $show['milestone_project_data'] = DB::table('project_details_tb')->where('id',$sow_id)->get();
         $show['sow_details'] = DB::table('sow_tb')->where('u_id',$u_id)->where('dev_id',$dev_id)->where('sow_status',1)->get();

        // $show['project_complition_details'] = DB::table('project_complition_tb')->where('u_id',$login_id)->get();
        return view('client/milestone')->with($show);
    }

    public function submit_milestone(Request $request)
    {   
       $sow_id = $request->post('sow_id');
      $developer_sow_details = DB::table('sow_tb')->where('id',$sow_id)->first();

      $dev_id = $developer_sow_details->dev_id;

        request()->validate(
        [
            'milestone_name' => 'required',
            'work' => 'required',
            'days' => 'required',
            // 'milestone_pdf' => ['required', 'mimes:pdf','max:1000mb']
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
            return redirect()->route('show_milestone',['sow_id'=>$sow_id]);
        }
        else
        {
            session(['message' =>'danger', 'milestoneerrmsg'=>'Milestone Added Failed.']); 
            return redirect()->back();
        }
    }

    public function show_milestone($sow_id)
    {   
        $login_id=Session::get('client_login_id'); 

        $show['milestone'] = DB::table('milestone_tb')->where('sow_id',$sow_id)->orderby('id','desc')->get();
        $show['developer_price_details'] = DB::table('developer_details_tb')->get();

        $show['project_complition_details'] = DB::table('project_complition_tb')->get();
        return view('client/show_milestone')->with($show);
    }

    public function update_milestone(Request $request)
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
    public function delete_milestone($id)
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

    public function milestone_accept($sow_value,$id)
    {
        $data=array(
            'status'=>$sow_value,
        );
    
        $info_delete=DB::table('milestone_tb')->where('id',$id)->update($data);
        if($info_delete==true)
        {
            
            session(['message' =>'success', 'milestoneerrmsg'=>'Milestone Accept.']); 
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    }

    public function milestone_reject($sow_value,$id,Request $request)
    {
        $data=array(
            'status'=>$sow_value,
            'milestone_reject'=>$request->post('milestone_reject'),
        );
    
        $info_delete=DB::table('milestone_tb')->where('id',$id)->update($data);
        if($info_delete==true)
        {
            
            session(['message' =>'success', 'milestoneerrmsg'=>'Milestone Reject.']); 
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    } 

    // public function milestone_approve($id)
    // {
    //     $milestone_approve = DB::table('milestone_tb')->where('id',$id)->first();

    //     $approve = $milestone_approve->approve;
    //     $sow_id = $milestone_approve->sow_id;
    //     $milestone_name = $milestone_approve->milestone_name;

    //     $dev_Details = DB::table('developer_details_tb')->where('dev_id',$dev_id)->first();

    //     $emails=array();
        
    //     $emails[]= $dev_Details->email;
    //     $email= $dev_Details->email;
    //     $name= $dev_Details->name;

    //     $datas=array(
    //         'name'=>$name,
    //         'milestone_name'=>$milestone_name,
    //     );

    //     if( $approve == 0){

    //         $data=array(
    //             'approve'=>1,
    //         );
        
    //         $info_delete=DB::table('milestone_tb')->where('id',$id)->update($data);
    //         if($info_delete==true)
    //         {
                
    //             Mail::send('milestone_approve_mail',$datas, function($message) use ($emails) {
    //                 $message->to($emails)->subject('Mellow Elements');
    //                 $message->from('dev@mellowelements.in', 'Mellow Elements');
    //             });
    //             session(['message' =>'success', 'milestoneerrmsg'=>'Milestone Approve.']); 
    //             return redirect()->back();
    //         }
    //         else
    //         {
                
    //             return redirect()->back();
    //         }
    //     }
    // } 
    
    public function milestone_pdf_download($id)
    {   
        $details = DB::table('milestone_tb')->where('id','=',$id)->first();
                   
        $file = $details->milestone_pdf;
        $myFile = public_path('upload/milestone/'.$file);
        return response()->download($file); 
    }

    public function completion_approve($id)
    {

        // $completion_status = $milestone_approve->completion_status;
        // $dev_id = $milestone_approve->dev_id;
        // $milestone_name = $milestone_approve->milestone_name;

        // $dev_Details = DB::table('developer_details_tb')->where('dev_id',$dev_id)->first();

        // $emails=array();
        
        // $emails[]= $dev_Details->email;
        // $email= $dev_Details->email;
        // $name= $dev_Details->name;

        // $datas=array(
        //     'name'=>$name,
        //     'milestone_name'=>$milestone_name,
        // );

            $data=array(
                'completion_status'=>1,
            );
        
            $info_delete=DB::table('milestone_tb')->where('id',$id)->update($data);
            if($info_delete==true)
            {
                // Mail::send('milestone_completion_approve_mail',$datas, function($message) use ($emails) {
                //     $message->to($emails)->subject('Mellow Elements');
                //     $message->from('dev@mellowelements.in', 'Mellow Elements');
                // });
                session(['message' =>'success', 'milestoneerrmsg'=>'Milestone Completion Approve.']); 
                return redirect()->back();
            }
            else
            {
                session(['message' =>'success', 'milestoneerrmsg'=>'Milestone Completion Not Approve.']); 
                return redirect()->back();
            }
    } 


    public function completion_disapprove_reason(Request $request)
    {
        $login_id=Session::get('client_login_id');

        $id = $request->post('update');

        // $milestone_disapprove = DB::table('milestone_tb')->where('id',$id)->first();
        // $dev_id = $milestone_disapprove->dev_id;
        // $milestone_name = $milestone_disapprove->milestone_name; 

        // $dev_Details = DB::table('developer_details_tb')->where('dev_id',$dev_id)->first();

        // $emails=array();
        
        // $emails[]= $dev_Details->email;
        // $email= $dev_Details->email;
        // $name= $dev_Details->name;

        // $datas=array(
        //     'name'=>$name,
        //     'milestone_name'=>$milestone_name,
        // );  

        request()->validate(
        [
            'completion_disapp_res' => 'required',
           
        ]);

        $data=array(
            'completion_disapp_res'=>$request->post('completion_disapp_res'),
            'completion_status'=>2,
        );

        $id=$request->post('update');       
        $result=DB::table('milestone_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            // Mail::send('milestone_completion_disapprove_mail',$datas, function($message) use ($emails) {
            //         $message->to($emails)->subject('Mellow Elements');
            //         $message->from('dev@mellowelements.in', 'Mellow Elements');
            //     });
            session(['message' =>'success', 'milestoneerrmsg' =>'Disapprove reason send Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'milestoneerrmsg'=>'Disapprove reason send Failed.']); 
            return redirect()->back();
        }
    }


    public function developer_rating(Request $request)
    {   
       $login_id=Session::get('client_login_id'); 

       $sow_id = $request->post('sow_id');

       $sow_details = DB::table('sow_tb')->where('id',$sow_id)->get();

        foreach ($sow_details as $s) {
           $dev_id = $s->dev_id;
        }

        request()->validate(
        [
            'milestone_id' => 'required',
            'logical_stability' => 'required|integer|between:1,5',
            'code_quality' => 'required|integer|between:1,5',
            'understanding' => 'required|integer|between:1,5',
            'communication' => 'required|integer|between:1,5',
            'behaviour' => 'required|integer|between:1,5',
            'work_performance' => 'required|integer|between:1,5',
            'delivary_review' => 'required|integer|between:1,5',
        ]);


        $data=array(
            'u_id'=>$login_id,
            'dev_id'=>$dev_id,
            'milestone_id'=>$request->post('milestone_id'),
            'sow_id'=>$request->post('sow_id'),
            'logical_stability'=>$request->post('logical_stability'),
            'code_quality'=>$request->post('code_quality'),
            'understanding'=>$request->post('understanding'),
            'communication'=>$request->post('communication'),
            'behaviour'=>$request->post('behaviour'),
            'work_performance'=>$request->post('work_performance'),
            'delivary_review'=>$request->post('delivary_review'),
            'date'=>date('y/m/d')
        );

        $result=DB::table('developer_rating')->insert($data);

        $ratingData=array(
            'rating_status'=>'1',
        );

        $milestone_id= $request->post('milestone_id');
        DB::table('milestone_tb')->where('id',$milestone_id)->update($ratingData);

        if($result==true)
        {
            session(['message' =>'success', 'milestoneerrmsg' =>'Thank You For Rating..']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'milestoneerrmsg'=>'Rating Failed..']); 
            return redirect()->back();
        }
    }


    public function client_advance_payment(Request $request,$sow_id)
    {        
       $login_id=Session::get('client_login_id'); 

        $show['milestone'] = DB::table('milestone_tb')->where('sow_id',$sow_id)->orderby('id','desc')->get();
        $show['developer_price_details'] = DB::table('developer_details_tb')->get();

        $show['project_complition_details'] = DB::table('project_complition_tb')->get();
        // return view('client/show_milestone')->with($show);
        
        session(['sow_id' => $sow_id]);

        $tprice= Session::get('total_price');
                
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
            'description' => 'Buy Plan Payment',
        ];
        // Let's checkout payment page is it working    
        return view('client/client_advance_payment',compact('response'))->with($show);
    }

    public function advance_payment(Request $request)
    { 

        $tprice= Session::get('total_price');
        $login_id=Session::get('client_login_id');
        $sow_id=Session::get('sow_id');

        $signatureStatus = $this->SignatureVerify(
            $request->all()['rzp_signature'],
            $request->all()['rzp_paymentid'],
            $request->all()['rzp_orderid']
        );
        
        if($signatureStatus == true)
        {
            $details = DB::table('milestone_tb')->where('sow_id','=',$sow_id)->where('advance_payment_status','=',Null)->get();
               
            foreach($details as $c)
            {
                $id = $c->id;
                $dev_id = $c->dev_id;

                $order_data=array(
                    'u_id'=>$login_id,
                    'sow_id'=>$sow_id,
                    'advance_price'=>$tprice,
                    'milestone_id'=>$id,
                    'dev_id'=>$dev_id,
                    'razorpay_payment_id'=>$request->all()['rzp_paymentid'],
                    'date' => date("Y-m-d")             
                );              
                DB::table('client_advance_payment_tb')->insert($order_data);

                $payment_data=array(
                    'advance_payment_status'=>'1',
                );  

                DB::table('milestone_tb')->where('id','=',$id)->update($payment_data);

                // $count = DB::table('developer_order_tb')->where('payment_status' ,'=', 'SUCCESS')->where('u_id' ,'=', $u_id )->where('dev_id',$id )->count();

                 $developerData=array(
                    'developer_status'=>'Booked',          
                );       
                 $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($developerData);
                }
            

            session(['message' =>'danger', 'errmsg'=>'Payment Completed']); 
            return redirect()->route('client_resource');   
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Payment Not Completed']); 
            return redirect()->back();
        }
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
    
    
    public function kycForm()
    {
        $employerId = Session::get('client_login_id');
        $kyc = EmployerKyc::where('employer_id', $employerId)->first();
        return view('client.kyc_form', compact('kyc'));
    }

    public function kycStore(Request $request)
    {
        $employerId = Session::get('client_login_id');

        $kyc = EmployerKyc::where('employer_id', $employerId)->first();
        $employer_kyc_id = $kyc ? $kyc->id : '';

        $request->validate([
            'gst_number' => 'required|unique:employer_kyc,gst_number,' . $employer_kyc_id,
            'pan_number' => 'required|unique:employer_kyc,pan_number,' . $employer_kyc_id,
            'adhar_number' => 'required|unique:employer_kyc,adhar_number,' . $employer_kyc_id,
            'business_type' => 'required|string',
            'kyc_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'adhar_img' => 'nullable|file|mimes:jpg,jpeg,png',
            'pan_img' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        try {
            $data = $request->only(['gst_number', 'pan_number', 'adhar_number', 'business_type']);

            // Handle file uploads manually using move()
            if ($request->hasFile('kyc_document')) {
                $filename = time() . '_kyc.' . $request->file('kyc_document')->getClientOriginalExtension();
                $request->file('kyc_document')->move(public_path('upload/adhar_card'), $filename);
                $data['kyc_document'] = 'upload/adhar_card/' . $filename;
            } elseif ($kyc && $kyc->kyc_document) {
                $data['kyc_document'] = $kyc->kyc_document;
            }

            if ($request->hasFile('adhar_img')) {
                $filename = time() . '_adhar.' . $request->file('adhar_img')->getClientOriginalExtension();
                $request->file('adhar_img')->move(public_path('upload/adhar_card'), $filename);
                $data['adhar_img'] = 'upload/adhar_card/' . $filename;
            } elseif ($kyc && $kyc->adhar_img) {
                $data['adhar_img'] = $kyc->adhar_img;
            }

            if ($request->hasFile('pan_img')) {
                $filename = time() . '_pan.' . $request->file('pan_img')->getClientOriginalExtension();
                $request->file('pan_img')->move(public_path('upload/pan_card'), $filename);
                $data['pan_img'] = 'upload/pan_card/' . $filename;
            } elseif ($kyc && $kyc->pan_img) {
                $data['pan_img'] = $kyc->pan_img;
            }

            EmployerKyc::updateOrCreate(
                ['employer_id' => $employerId],
                $data
            );
            
            // ✅ Update is_bkyc_done in Employer (user_login) table
           Employer::where('id', $employerId)->update(['is_kyc_done' => 1]);

            return redirect()->back()->with('success', 'KYC details submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }



    public function bankForm()
    {
        $employerId = Session::get('client_login_id');
        $bank = EmployerBankDetail::where('employer_id', $employerId)->first();
        return view('client.bank_form', compact('bank'));
    }


    public function bankStore(Request $request)
{
    $validated = $request->validate([
        'account_holder_name' => 'required|string|max:255',
        'account_number' => 'required|string|max:50',
        'ifsc_code' => 'required|string|max:20',
        'bank_name' => 'required|string|max:255',
        'branch_name' => 'nullable|string|max:255',
        'account_type' => 'nullable|in:Current,Saving,Other',
        'bank_doc_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $employerId = Session::get('client_login_id');

    // Initialize data to save
    $data = $validated;
    $data['employer_id'] = $employerId;

    // Handle file upload
    if ($request->hasFile('bank_doc_proof')) {
        $filename = time() . '_bank_doc.' . $request->file('bank_doc_proof')->getClientOriginalExtension();
        $request->file('bank_doc_proof')->move(public_path('upload/pan_card'), $filename);
        $data['bank_doc_proof'] = 'upload/pan_card/' . $filename;
    }

    // Update if exists, else create
    EmployerBankDetail::updateOrCreate(
        ['employer_id' => $employerId],
        $data
    );
    
    // ✅ Update is_bank_done in Employer (user_login) table
    Employer::where('id', $employerId)->update(['is_bank_done' => 1]);

    return redirect()->back()->with('success', 'Bank details submitted.');
}

    
}
