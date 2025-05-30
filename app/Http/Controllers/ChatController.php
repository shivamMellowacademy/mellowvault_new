<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Validation\Rule;


class ChatController extends Controller
{
    public function submit_chat(Request $request)
    {   
       
        request()->validate(
        [
            'message' => 'required',
        ]);

        $u_id=Session::get('user_login_id'); 

        $data = DB::table('user_login')->where('id',$u_id)->get();

        foreach ($data as $k) 
        {
        	$u_id = $k->id;
            $fname = $k->fname;
            $email = $k->email;
        }
       
        $data=array(
        	'u_id'=>$u_id,
        	'user_name'=>$fname,
        	'email'=>$email,
            'message'=>$request->post('message'),
            'date'=>date('y-m-d h:i:s')
        );

        $result=DB::table('chat_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'success', 'chaterrmsg' =>'Message Send Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'chaterrmsg'=>'Message Not Send']); 
            return redirect()->back();
        }
    }
}
