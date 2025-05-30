<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Validation\Rule;
use Mail;

class frontController extends Controller
{
    private $razorpayId = "rzp_live_k8FyLiwKwfBx2j";
    private $razorpayKey = "ltaegAk3x7CH3RPRhcs5eUDV";

    public function developer_order_data()
    { 
        $u_id=Session::get('user_login_id');  
        return  $developer_order_details = DB::table('developer_order_tb')->where('payment_status' ,'=', 'SUCCESS')->where('u_id' ,'=', $u_id )->count();
    }

    public function index()
    {  
        
        $show['pro'] = DB::table('product_tb')->selectRaw('c_id, count(id) as count_id')->groupBy('c_id')->get();
        $show['allproduct'] = DB::table('product_tb')->orderby('id','desc')->paginate(4); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['higher_professional_show'] = DB::table('higher_professional_tb')->orderby('id','desc')->paginate(8);

        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.price','product_tb.pro_size','product_tb.video','product_tb.tax','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        $show['developer_order_details']=$this->developer_order_data();

        $ip = request()->ip();
        
        $current_date = date('y-m-d');
        $count = DB::table('visitor_tb')->where('ip',$ip)->where('date',$current_date)->count();
        if($count == 0){

            $data=array(
                'ip'=>$ip,
                'date'=>date('Y-m-d')
            );
            $result=DB::table('visitor_tb')->insert($data);
        }

		return view('front/index')->with($show);
    }
    
    public function aboutus()
    {   

        $show['developer_order_details']=$this->developer_order_data();

        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
		$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		return view('front/about')->with($show);
    }

   public function product($c_id)
    { 
        $details['developer_order_details']=$this->developer_order_data();
        $details['user_details'] = DB::table('user_login')->orderby('id','desc')->get();   
        $details['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $details['pro'] = DB::table('product_tb')->where('c_id', $c_id)->paginate(9);
        $details['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $details['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $details['web_details'] = DB::table('web_setting')->get();

        $details['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.price','product_tb.video','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 
        
        $details['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $details['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $details['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $details['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        $details['product_purchase'] = DB::table('cart_tb')->where('status' ,'=', 'Order')->where('u_id' ,'=', $u_id )->count();

        return view('front/product')->with($details);
    }

    public function subproduct($subcategory_id)
    {
        $showss['developer_order_details']=$this->developer_order_data();
        $showss['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $showss['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $showss['product_detail'] = DB::table('product_tb')->where('subcategory_id', $subcategory_id)->paginate(9);
        $showss['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $showss['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $showss['web_details'] = DB::table('web_setting')->get();

        $showss['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $showss['go_to_cart'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        $showss['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $showss['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $showss['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $showss['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        $showss['product_purchase'] = DB::table('cart_tb')->where('status' ,'=', 'Order')->where('u_id' ,'=', $u_id )->get();

        return view('front/subproduct')->with($showss);
    }

    public function product_details($id)
    {
        $shows['developer_order_details']=$this->developer_order_data();
        $shows['comment'] = DB::table('comment_tb')->orderby('id','desc')->get(); 
        $shows['reply_comm'] = DB::table('reply_comment_tb')->orderby('id','Asc')->get(); 
        $shows['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $shows['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $shows['allproduct'] = DB::table('product_tb')->where('id', $id)->get();
        $shows['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $shows['web_details'] = DB::table('web_setting')->get();
        $shows['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $ip = request()->ip();
        
        $shows['rate']=DB::table('rating_tb')->selectRaw('rating')->where('ip','=',$ip)->where('p_id','=',$id)->get();

        $shows['rate_value']=DB::table('rating_tb')->selectRaw('rating')->where('ip','=',$ip)->where('p_id','=',$id)->count();

        $shows['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $shows['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $shows['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $shows['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $shows['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        
        $shows['product_go_to_cart'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->where('p_id',$id )->count();

        $shows['product_purchase'] = DB::table('cart_tb')->where('status' ,'=', 'Order')->where('u_id' ,'=', $u_id )->where('p_id',$id )->count();

        return view('front/product_details')->with($shows);
    }

    public function product_show($id)
    {
        $shows['developer_order_details']=$this->developer_order_data();
        $shows['comment'] = DB::table('comment_tb')->orderby('id','desc')->get(); 
        $shows['reply_comm'] = DB::table('reply_comment_tb')->orderby('id','Asc')->get(); 
        $shows['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $shows['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $shows['allproduct'] = DB::table('product_tb')->where('id', $id)->get();
        $shows['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $shows['web_details'] = DB::table('web_setting')->get();
        $shows['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $ip = request()->ip();
        
        $shows['rate']=DB::table('rating_tb')->selectRaw('rating')->where('ip','=',$ip)->where('p_id','=',$id)->get();

        $shows['rate_value']=DB::table('rating_tb')->selectRaw('rating')->where('ip','=',$ip)->where('p_id','=',$id)->count();

        $shows['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $shows['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $shows['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $shows['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $shows['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        
        $shows['product_go_to_cart'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->where('p_id',$id )->count();

        $shows['product_purchase'] = DB::table('cart_tb')->where('status' ,'=', 'Order')->where('u_id' ,'=', $u_id )->where('p_id',$id )->count();

        return view('front/product_show')->with($shows);
    }
    
    
    public function contact()
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['cont'] = DB::table('contact_details_tb')->orderby('id','desc')->get();  
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get();  
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        return view('front/contact')->with($show);
    }

    public function submit_query(Request $req)
    {
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get();
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone' => 'required|digits:10',
            'mesage' => 'required'
        ]);     
        $data = array(
            'name'=>$req->post('name'),
            'email'=>$req->post('email'),
            'subject'=>$req->post('subject'),
            'phone'=>$req->post('phone'),
            'mesage'=>$req->post('mesage'),
            'date'=>date('y/m/d')
        );      
        $result=DB::table('contact_tbs')->insert($data);

        $email=$req->post('email'); 
        
            $details = DB::table('contact_tbs')->where('email',$email)->get();
            $emails=array();
            foreach ($details as $key) 
            {
                $emails[]= $key->email;
                
            }

           $datas=array(
                'name'=>"Mellow Element"
            );

        if ($result==true) 
        {
            session(['message' =>'success', 'errmsg' =>'Enquiry Submit Successfully. We Will Contact You Very Soon...']);
            
            Mail::send('contact_us_mail', $datas, function($message) use ($emails) {
                $message->to($emails)->subject('Mellow Element');
                $message->from('dev@mellowelements.in', 'Mellow Elements');
                
            });

            return view('front/contact_thankyou')->with($show);
        }
        else
        {
            session(['message' =>'danger', 'errmsg' =>'Enquiry Submit failed. Please Try Again....']);
            return redirect()->back();
        }           
    }
    
    public function refund_policy()
    { 
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['privacy'] = DB::table('privacy_policy_tb')->orderby('id','desc')->get();
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        
        return view('front/refund')->with($show);
    }

     public function privacy()
    {   
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['privacy'] = DB::table('privacy_policy_tb')->orderby('id','asc')->get();
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/privacy')->with($show);
    }

    public function term()
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['term'] = DB::table('term_tb')->orderby('id','asc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/term')->with($show);
    }

    public function download($id)
    { 
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

         $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();


        if(!empty(Session::get('user_login_id'))) {

            $u_id = Session::get('user_login_id');
            $use = DB::table('order_tb')->where([['u_id','=' , $u_id],['payment_status', 'SUCCESS'],['p_id','=' , $id]])->count();
            if($use > 0 )
            {
                $show= DB::table('order_tb')->where([['u_id','=' , $u_id],['payment_status', 'SUCCESS'],['p_id','=' , $id]])->get();
                foreach($show as $s)            
                {
                    $p_id=$s->p_id;
                    $details = DB::table('product_tb')->where('id','=',$p_id)->first();

                    $source_code = $details->source_code;
                    $video = $details->video;

                    if($source_code == '' && $video == ''){
                        $file = $details->psd;
                        $myFile = public_path('upload/psd/'.$file);
                        return response()->download($myFile); 
                    }elseif($source_code == '' && $video != ''){
                        $file = $details->video;
                        $myFile = public_path('upload/video/'.$file);
                        return response()->download($myFile); 
                    }
                    else{
                        $file = $details->source_code;
                        $myFile = public_path('upload/source_code/'.$file);
                        return response()->download($file); 
                    }
                }
            }
            else
            {
                session(['message' =>'danger', 'errmsg'=>'Payment not complete']); 
                return redirect()->back();
            }
        }
        else
        {
            return view('front/registration')->with($show);
        }
    }

    public function commercial_license()
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['license'] = DB::table('license_tb')->orderby('id','desc')->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        
        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        
        return view('front/commercial_license')->with($show);
    }
    
    public function order_history()
    {   
        $show['developer_order_details']=$this->developer_order_data();
        $u_id=Session::get('user_login_id'); 

        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $show['order_history'] = DB::table('order_tb')
        ->select('product_tb.name','product_tb.image','product_tb.price','product_tb.id','order_tb.u_id','order_tb.p_id','order_tb.date')
        ->join('product_tb','product_tb.id', '=', 'order_tb.p_id')
        ->get();

        $show['order_history_emprty'] = DB::table('order_tb')->where('u_id',$u_id)->count();


        $show['dev_order_history'] = DB::table('developer_order_tb')
        ->select('developer_details_tb.name','developer_details_tb.image','developer_details_tb.perhr','developer_details_tb.dev_id','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.date')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->get();

        $show['dev_order_history_empty'] = DB::table('developer_order_tb')->where('u_id',$u_id)->count();

        

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/order_history')->with($show);
    }


    public function faq()
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['pro'] = DB::table('product_tb')->selectRaw('c_id, count(id) as count_id')->groupBy('c_id')->get();
        $show['faq_details'] = DB::table('faq_tb')->orderby('id','desc')->get(); 
        $show['allproduct'] = DB::table('product_tb')->orderby('id','desc')->limit(3)->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();
        
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/faq')->with($show);
    }
    
    public function blogs()
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['pro'] = DB::table('product_tb')->selectRaw('c_id, count(id) as count_id')->groupBy('c_id')->get();
        $show['faq_details'] = DB::table('faq_tb')->orderby('id','desc')->get(); 
        $show['blogdetails'] = DB::table('blog_tb')->orderby('id','desc')->get(); 
        $show['blogbydetails'] = DB::table('blog_tb')->orderby('id','desc')->limit(4)->get();
        $show['blogpag'] = DB::table('blog_tb')->paginate(2);
        $show['allproduct'] = DB::table('product_tb')->orderby('id','desc')->limit(3)->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();
        
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/blogs')->with($show);
    }
    
    public function blog_details(Request $request, $id)
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['pro'] = DB::table('product_tb')->selectRaw('c_id, count(id) as count_id')->groupBy('c_id')->get();
        $show['faq_details'] = DB::table('faq_tb')->orderby('id','desc')->get(); 
        $show['blogdetails'] = DB::table('blog_tb')->orderby('id','desc')->get(); 
        $show['blog_by_details'] = DB::table('blog_tb')->where('id',$id)->get();
        $show['blogbydetails'] = DB::table('blog_tb')->orderby('id','desc')->limit(4)->get();
        $show['blogpag'] = DB::table('blog_tb')->orderby('id','desc')->paginate(2);
        $show['allproduct'] = DB::table('product_tb')->orderby('id','desc')->limit(3)->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();
        
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/blog_details')->with($show);
    }

    public function autosearch(Request $request)
    {   
        $usersearch = $request->post('usersearch');

        $data = DB::table('product_tb')->where( 'name', 'LIKE', '%' . $usersearch . '%')->orderby('id','desc')->get();

        foreach ($data as $dd) 
        {       
            $url = route('product_details',['id'=>''.$dd->id.'']);
            $output='<a href="'.$url.'"><li style="text-align: left;font-size: 10;" value="'.$dd->id.'">'.$dd->name.'</li></a>'; 
            echo $output; 

            // $output = $dd->name ; 
            // echo $output; 
        }
          
    }

    public function developer_rating_details($dev_id)
    {  
        $show['developer_order_details']=$this->developer_order_data();

        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        
        $show['dev_rating_details'] = DB::table('developer_rating')
        ->select('sow_tb.id','sow_tb.subject','developer_rating.sow_id','developer_rating.logical_stability','developer_rating.code_quality','developer_rating.understanding','developer_rating.communication','developer_rating.behaviour','developer_rating.work_performance','developer_rating.delivary_review','developer_rating.id','developer_rating.milestone_id')
        ->join('sow_tb','sow_tb.id', '=', 'developer_rating.sow_id')
        ->where('developer_rating.dev_id',$dev_id)
        ->groupBy('developer_rating.sow_id')
        ->get();

        $show['developer_rating'] = DB::table('developer_rating')->where('dev_id',$dev_id)->get();

        $show['developer_milestone'] = DB::table('milestone_tb')->get();

        $show['developer_rating_total'] = DB::table('developer_rating')
        ->select('sow_tb.id','sow_tb.subject','developer_rating.sow_id','developer_rating.logical_stability','developer_rating.code_quality','developer_rating.understanding','developer_rating.communication','developer_rating.behaviour','developer_rating.work_performance','developer_rating.delivary_review','developer_rating.id','developer_rating.milestone_id')
        ->join('sow_tb','sow_tb.id', '=', 'developer_rating.sow_id')
        ->where('developer_rating.dev_id',$dev_id)
        ->groupBy('sow_id')
        ->count();

        return view('front/developer_rating_details')->with($show);
    }
    
     public function hosting()
    {   

        $u_id=Session::get('user_login_id'); 

        $show['developer_order_details']=$this->developer_order_data();

        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['hosting'] = DB::table('web_hosting_tb')->orderby('id','asc')->get();
        $show['web_details'] = DB::table('web_setting')->get();

        // $show['hosting_order_Details'] = DB::table('buynow_order_tb')->where('u_id' ,'=', $u_id )->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/hosting')->with($show);
    }

    public function buy_now($id)
    {   
        $u_id=Session::get('user_login_id'); 

        $show['developer_order_details']=$this->developer_order_data();

        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['hosting'] = DB::table('web_hosting_tb')->where('id',$id)->get();
        $show['web_details'] = DB::table('web_setting')->get();

        $show['hosting_order_Details_total'] = DB::table('buynow_order_tb')->where('u_id' ,'=', $u_id )->where('p_id' ,'=', $id )->count();
        $show['hosting_order_Details'] = DB::table('buynow_order_tb')->where('u_id' ,'=', $u_id )->where('p_id' ,'=', $id )->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        if(!empty($u_id)){
            return view('front/buy_now')->with($show);
        }else{
            return view('front/login')->with($show);
        }
    }

    public function payment_initiate_buy_now(Request $request, $id)
    {
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();
        $show['hosting'] = DB::table('web_hosting_tb')->where('id',$id)->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();


        $fname = $request->post('fname');
        $lname = $request->post('lname');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $company_name = $request->post('company_name');
        $country = $request->post('country');
        $state = $request->post('state');
        $city = $request->post('city');
        $address_one = $request->post('address_one');
        $address_two = $request->post('address_two');
        $code = $request->post('code');
        $gst = $request->post('gst');
        
        $purpose = $request->post('purpose');


        session(['fname' => $fname]);
        session(['lname' => $lname]);
        session(['email' => $email]);
        session(['phone' => $phone]);
        session(['company_name' => $company_name]);
        session(['country' => $country]);
        session(['state' => $state]);
        session(['city' => $city]);
        session(['address_one' => $address_one]);
        session(['address_two' => $address_two]);
        session(['code' => $code]);
        session(['gst' => $gst]);
        
        session(['purpose' => $purpose]);
        
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

       request()->validate([
                    'phone' => 'required|digits:10',
                ]);
        // Return response on payment page
        $response = [
            'orderId' => $order['id'],
            'razorpayId' => $this->razorpayId,
            'currency' => 'INR',
            'amount' => $final,         
            'fname' =>$fname,
            'lname' =>$lname,             
            'email' => $email,
            'phone' =>$phone,
            'company_name' =>$company_name,
            'country' =>$country,
            'state' =>$state,
            'city' =>$city,
            'address_one' =>$address_one,
            'address_two' =>$address_two,
            'code' =>$code,
            'gst' =>$gst,
            'purpose' =>$purpose,
            'description' => 'Buy Plan Payment',
        ];
        // Let's checkout payment page is it working    
        return view('front/payment_buy_now',compact('response'))->with($show);
    }

    public function checkout_buy_now(Request $request,$id)
    { 
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['hosting'] = DB::table('web_hosting_tb')->where('id',$id)->get();
        $show['web_details'] = DB::table('web_setting')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        $fname=Session::get('fname');
        $lname=Session::get('lname');
        $email=Session::get('email');
        $phone=Session::get('phone');
        $company_name=Session::get('company_name');
        $country=Session::get('country');
        $state=Session::get('state');
        $city=Session::get('city');
        $address_one=Session::get('address_one');
        $address_two=Session::get('address_two');
        $code=Session::get('code');
        $gst=Session::get('gst');
        
        $purpose=Session::get('purpose');
        $tprice= Session::get('total_price');

        $signatureStatus = $this->SignatureVerify(
            $request->all()['rzp_signature'],
            $request->all()['rzp_paymentid'],
            $request->all()['rzp_orderid']
        );
        // If Signature status is true We will save the payment response in our database
        // In this tutorial we send the response to Success page if payment successfully made
        if($signatureStatus == true)
        {
            

            $u_id=Session::get('user_login_id'); 
            $order_id = rand(0,9999);
            
            $cart = DB::table('web_hosting_tb')->where('id','=',$id)->get();      
                
                foreach($cart as $c)
                {
                    $order_data=array(
                    'order_id'=>$order_id,
                    'u_id'=>$u_id,
                    'fname'=>$fname,
                    'lname'=>$lname,
                    'email'=>$email,
                    'phone'=>$phone,
                    'company_name'=>$company_name,
                    'country'=>$country,
                    'state'=>$state,
                    'city'=>$city,
                    'address_one'=>$address_one,
                    'address_two'=>$address_two,
                    'code'=>$code,
                    'gst'=>$gst,
                    'purpose'=>$purpose,
                    'p_id'=>$c->id,
                    'tprice'=>$tprice,
                    'status'=>'Booked',             
                    'payment_status'=>'SUCCESS',
                    'date' => date("Y-m-d")             
                    );              
                    DB::table('buynow_order_tb')->insert($order_data);

                    $payment_data=array(
                    'order_id'=>$order_id,
                    'tprice'=>$tprice,
                    'razorpay_payment_id'=>$request->all()['rzp_paymentid'],
                    'date' => date("Y-m-d")
                    );  

                    DB::table('buynow_payment_tb')->insert($payment_data);
                    
                    $email=Session::get('email');
                    $details = DB::table('buynow_order_tb')->where('email',$email)->get();
                    $emails=array();
                    foreach ($details as $key) 
                    {
                        $emails[]= $key->email;
                    }

                    $data = DB::table('buynow_order_tb')->where('email',$email)->get();
                    foreach ($data as $k) 
                    {
                        $fname = $k->fname;
                        $order_id = $k->order_id;
                        $url = route('contact');
                    }
                    $datas=array(
                        'fname'=>$fname,
                        'order_id'=>$order_id,
                        'link'=>$url
                    );

                    $details=array(
                        'order_id'=>$order_id,
                    );

                    Mail::send('payment_mail', $datas, function($message) use ($emails) {
                        $message->to($emails)->subject('Mellow Element');
                        $message->from('dev@mellowelements.in', 'Mellow Elements');   
                    });

                    Mail::send('admin_information_mail', $details, function($message) {
                       $message->to('mellowpayalchandra@gmail.com')->subject('Mellow Element');
                       $message->from('dev@mellowelements.in', 'Mellow Element');  
                    });

                }

                return redirect()->route('buynow_thank_you');
        }
        else
        {
            // You can create this page
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

    public function buynow_thank_you()
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['web_details'] = DB::table('web_setting')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/buynow_thank_you')->with($show);
    }

    public function view_invoice($order_id)
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['web_details'] = DB::table('web_setting')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        $count = DB::table('buynow_order_tb')->where('order_id','=',$order_id)->count();
        if($count > 0) {
            $show['invoice'] = DB::table('buynow_order_tb')->where('order_id',$order_id)->groupBy('order_id')->orderby('id','desc')->get(); 
            $show['payment'] = DB::table('buynow_payment_tb')->where('order_id',$order_id)->orderby('id','desc')->get();
           
            $show['details'] = DB::table('buynow_order_tb')
            ->select('web_hosting_tb.hostingname','web_hosting_tb.hostingprice','buynow_order_tb.order_id','buynow_order_tb.tprice','buynow_order_tb.p_id')
            ->join('web_hosting_tb', 'web_hosting_tb.id', '=', 'buynow_order_tb.p_id')
            ->where('buynow_order_tb.order_id', $order_id)
            ->get();

            return view('front/view_invoice')->with($show);
        }else {

            return redirect()->back();
        }
    }
}


