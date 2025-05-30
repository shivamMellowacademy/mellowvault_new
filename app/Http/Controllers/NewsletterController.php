<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class NewsletterController extends Controller
{
    public function store(Request $request)
    {
    	request()->validate(
		[
			'email' => 'required',
		]);	
		$email=$request->post('email');			
		$count = DB::table('subscribe_tb')->where('email',$email)->count();
        if($count == 0) {
			$data=array(
				'email'=>$request->post('email'),
			);
			$result=DB::table('subscribe_tb')->insert($data);
			if($result==true){				
	            session(['message' =>'success', 'storeerrmsg'=>'Thank you For Subscribing!']); 
				return redirect()->back();
			}  
			else{
	            session(['message' =>'danger', 'storeerrmsg'=>'Unable To Subscribing']); 
	            return redirect()->back();
        	}
		} 
		else{
            session(['message' =>'danger', 'storeerrmsg' =>'Email Id Already Exists.']);
            return redirect()->back();
        }         
    }
}
