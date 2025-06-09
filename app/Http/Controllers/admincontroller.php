<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
use App\Models\developerPremiumPrice;
use App\Models\Premium;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeePayoutExport;
use App\Exports\ActiveDeveloperDetailsExport;
use App\Exports\premiumDeveloperExcel;
use App\Exports\resoureDetailsExcel;
use App\Mail\StaffAccountCreated;
use App\Jobs\SendEmailJob;
use App\Exports\DeveloperDetialExcel;
use App\Exports\EmployerDetialExcel;
use Illuminate\Support\Facades\Hash;


class admincontroller extends Controller
{
    // private $razorpayId = "rzp_test_oGWqJW6LQBc9Gs";
    // private $razorpayKey = "EDknjtGrhABUsDq0FGfnYDM3";
    
    private $razorpayId = "rzp_live_k8FyLiwKwfBx2j";
    private $razorpayKey = "ltaegAk3x7CH3RPRhcs5eUDV";

    public function adminindex()
    {   
        return view('admin/index');
        
    }

    public function login_verification_admin(Request $request)
    {
        request()->validate(['email' => 'required|email','password' => 'required']);
        
        $email=$request->post('email');
        $password=$request->post('password');
        $use = DB::table('admin_tb')->where('email_id','=',$email)->where('pass_id','=',md5($password))->count();
        if($use > 0)
        {
            $details= DB::table('admin_tb')->where('email_id','=',$email)->get();
            foreach($details as $d)
            {
                $id=$d->id;
                $role=$d->role;
            }
            session(['admin_login_id' => $id,'admin_email_login' => $email,'admin_login_role' => $role]);
            session(['message' =>'success', 'errmsg' =>'Login Successfully.']);
            return redirect('dashboard');
        }
        else
        {
            session(['message' =>'danger','errmsg' =>'Login Failed ? Username and Password Wrong....']);
            return redirect()->back();
        }                  
    }

    public function logout()
    {
        Session::forget('admin_login_id');
        Session::forget('admin_email_login');
        Session::forget('admin_login_role');
        Session::flush();
        return redirect()->route('adminindex');
    }

    public function premium_developer()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['premium_developer_details'] = DB::table('premium_order_tb')->orderby('id','desc')->get();
        return view('admin/premium_developer')->with($data);;
    }
    
    public function interview_schedule_developer()
    {  
      
      $email= Session::get('admin_login_role');
      $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
      $data['interview_schedule_developer_details'] = DB::table('developer_details_tb')
        ->select('developer_interview_schedule.fname','developer_interview_schedule.lname','developer_interview_schedule.email','developer_interview_schedule.phone','developer_interview_schedule.dev_id','developer_interview_schedule.status','developer_interview_schedule.approve_status','developer_interview_schedule.interviewdateone','developer_interview_schedule.interviewdatetwo','developer_interview_schedule.interviewdatethree','developer_interview_schedule.schinterviewdatetime','developer_interview_schedule.interviewlink','developer_interview_schedule.perhr','developer_interview_schedule.review','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.address','developer_details_tb.rating','developer_details_tb.skills')
        ->join('developer_interview_schedule','developer_interview_schedule.dev_id', '=', 'developer_details_tb.dev_id')
        ->get();
        
        // $data['interview_schedule_developer_details'] = DB::table('developer_details_tb')
        // ->join('developer_interview_schedule', 'developer_interview_schedule.dev_id', '=', 'developer_details_tb.dev_id')
        // ->join('developer_order_tb', 'developer_order_tb.dev_id', '=', 'developer_interview_schedule.dev_id')
        // ->get();
        
        //exit();
        
        //$data['interview_schedule_developer_details'] = DB::table('developer_interview_schedule')->orderby('id','desc')->get();
        return view('admin/interview_schedule_developer')->with($data);
    }
    
    public function dashboard()
    {   
        $email= Session::get('admin_login_role');
       // echo $email; exit();
        $show['total_contact'] = DB::table('contact_tbs')->count();
        $show['higher_professional'] = DB::table('higher_professional_tb')->count();
        $show['total_product'] = DB::table('product_tb')->count();
        $show['popular_product'] = DB::table('product_tb')->orderby('id','desc')->get();
        $show['total_saving'] = DB::table('order_tb')->orderby('id','desc')->get();
        $show['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        //echo $show['details']; exit();
        $show['blog_detail'] = DB::table('blog_tb')->orderby('id','desc')->get();
        $show['detail'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $current_date = date('y-m-d');
        $show['total_visitor'] = DB::table('visitor_tb')->where('date',$current_date)->count();

        $show['transaction'] = DB::table('order_tb')
        ->select('product_tb.name','product_tb.id','order_tb.order_id','order_tb.p_id','order_tb.tprice','order_tb.payment_status')
        ->join('product_tb','product_tb.id', '=', 'order_tb.p_id')
        ->get();

        return view('admin/dashboard')->with($show);;
    }
    
    public function category()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['details'] = DB::table('category_tb')->orderby('id','desc')->get();
        return view('admin/category')->with($data);
    }
    
    public function submit_category(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
            'multiple_image.*' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);
    
        $multiple_image = '';
        if ($request->hasFile('multiple_image')) {
            $imgNames = [];
    
            foreach ($request->file('multiple_image') as $file) {
                $fileName = rand(0,999999999) . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/category/'), $fileName);
                $imgNames[] = $fileName;
            }
    
            $multiple_image = implode(",", $imgNames);
        }
    
        $singleImage = '';
        if ($request->hasFile('image')) {
            $singleImage = time() . '.' . $request->image->getClientOriginalExtension();
            $request->file('image')->move(public_path('upload/category/'), $singleImage);
        }
    
        $data = [
            'title' => $request->post('title'),
            'name' => $request->post('name'),
            'image' => $singleImage,
            'multiple_image' => $multiple_image,
        ];
    
        $result = DB::table('category_tb')->insert($data);
    
        if ($result) {
            session(['message' => 'Category Added Successfully...']);
        } else {
            session(['message' => 'Category Added Failed. Due To Internal Server Error..']);
        }
    
        return redirect()->back();
    }

    
    public function update_category(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
            'multiple_image.*' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);
    
        $uploadPath = public_path('upload/category/');
    
        // === Handle multiple images ===
        if ($request->hasFile('multiple_image')) {
            $imgNames = [];
            foreach ($request->file('multiple_image') as $file) {
                $fileName = rand(0, 999999999) . '_' . $file->getClientOriginalName();
                $file->move($uploadPath, $fileName);
                $imgNames[] = $fileName;
            }
            $multiple_image = implode(",", $imgNames);
    
            // Delete old multiple images AFTER new ones are uploaded
            $oldMultiple = explode(',', $request->post('old_multiple_image'));
            foreach ($oldMultiple as $oldFile) {
                if ($oldFile && File::exists($uploadPath . $oldFile)) {
                    File::delete($uploadPath . $oldFile);
                }
            }
        } else {
            $multiple_image = $request->post('old_multiple_image');
        }
    
        // === Handle single image ===
        if ($request->hasFile('image')) {
            $singleImage = time() . '.' . $request->image->getClientOriginalExtension();
            $request->file('image')->move($uploadPath, $singleImage);
    
            // Delete old image AFTER new one is uploaded
            $oldImage = $request->post('old_image');
            if ($oldImage && File::exists($uploadPath . $oldImage)) {
                File::delete($uploadPath . $oldImage);
            }
        } else {
            $singleImage = $request->post('old_image');
        }
    
        // === Update data ===
        $data = [
            'title' => $request->post('title'),
            'name' => $request->post('name'),
            'image' => $singleImage,
            'multiple_image' => $multiple_image,
        ];
    
        $id = $request->post('id');
        $result = DB::table('category_tb')->where('id', $id)->update($data);
    
        if ($result) {
            session(['message' => 'Category Details Updated Successfully...']);
        } else {
            session(['message' => 'Category Details Update Failed. Due To Internal Server Error..']);
        }
    
        return redirect()->back();
    }


    
    public function delete_category($id)
    {
        
        $info_delete=DB::table('category_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'errmsg'=>'Category Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Category Details Delete Failed ? Due To Internal Server Error...']); 
            return redirect()->back();
        }
    }  

    public function subcategory()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $data['subcategory'] = DB::table('subcategory_tb')->orderby('id','desc')->paginate(10);
        return view('admin/subcategory')->with($data);
    }

    // Filter subcategories
    public function searchSubcategory(Request $request)
    {
        $search = $request->get('search');
        $subcategory = DB::table('subcategory_tb')
                         ->where('heading', 'like', "%$search%")
                         ->orWhere('name', 'like', "%$search%")
                         ->orderby('id', 'desc')
                         ->paginate(10);
        return view('admin.subcategory_table_rows', compact('subcategory'))->render();
    }
    
    
    public function submit_subcategory(Request $request)
{   
    // Validate the input
    $request->validate(
    [
        'category_id' => 'required',
        'heading' => 'required',
        'name' => 'required',
        'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
    ]);

    // Get the original file name and create a unique name for it
    $getimageName = time().'.'.$request->image->getClientOriginalExtension();       

    // Define the path where the image will be stored
    $path = public_path('upload/subcategory/'.$getimageName);

    // Move the uploaded file to the specified path
    $request->file('image')->move(public_path('upload/subcategory'), $getimageName);

    // Prepare data to insert into the database
    $data = [
        'category_id' => $request->post('category_id'),
        'heading' => $request->post('heading'),
        'name' => $request->post('name'),
        'image' => $getimageName
    ];

    // Insert the data into the database
    $result = DB::table('subcategory_tb')->insert($data);

    // Return response based on the result
    if ($result) {
        session(['message' => 'Sub Category Added Successfully...']);
        return redirect()->back();
    } else {
        session(['message' => 'Sub Category Addition Failed. Due To Internal Server Error..']);
        return redirect()->back();
    }
}

    
public function update_subcategory(Request $request)
{    
    // Validate the input
    $request->validate(
    [
        'category_id' => 'required',
        'heading' => 'required',
        'name' => 'required',
        'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
    ]);  

    // If a new image is uploaded, process it
    if ($request->hasFile('image')) {
        $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
        // Define the path to save the new image
        $path = public_path('upload/subcategory/'.$getimageName);
        // Move the uploaded file to the specified path
        $request->file('image')->move(public_path('upload/subcategory'), $getimageName);
    } else {
        // If no new image is uploaded, keep the old image
        $getimageName = $request->post('old_image');
    }

    // Prepare the updated data for the subcategory
    $data = [
        'category_id' => $request->post('category_id'),
        'heading' => $request->post('heading'),
        'name' => $request->post('name'),
        'image' => $getimageName            
    ];

    // Update the subcategory data in the database
    $id = $request->post('update');
    $result = DB::table('subcategory_tb')->where('id', $id)->update($data);

    // Return response based on the result
    if ($result) {
        session(['message' => 'Sub Category Details Updated Successfully...']);
        return redirect()->back();
    } else {
        session(['message' => 'Sub Category Update Failed Due to Internal Server Error..']);
        return redirect()->back();
    }
}

    
    public function delete_subcategory($id)
    {
        
        $info_delete=DB::table('subcategory_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'Sub Category Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Sub Category Details Delete Failed ? Due To Internal Server Error...']); 
            return redirect()->back();
        }
    }  

    public function about()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['detail'] = DB::table('about_tb')->orderby('id','desc')->get();
        return view('admin/about')->with($data);
    }

    public function submit_about(Request $request)
    {
        
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);             
        $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
        $path = public_path('upload/about/'.$getimageName);
        $img = Image::make($request->file('image')->getRealPath())->save($path);
        $data=array(
            'heading'=>$request->post('heading'),
            'description'=>$request->post('description'),
            'image'=>$getimageName
        );
        $result=DB::table('about_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'About Details Upload Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'About Details Upload Failed. Due To Internal Server Error..']); 
            return redirect()->back();
        }
    } 

    public function update_about(Request $request)
    {
        
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',

        ]);
        if(!empty($request->file('image')))
        {
            $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
            $path = public_path('upload/about/'.$getimageName);
            $img = Image::make($request->file('image')->getRealPath())->save($path);
        }
        else
        {
            $getimageName=$request->post('old_image');
        }
        
        $data=array(
            'heading'=>$request->post('heading'),
            'description'=>$request->post('description'),
            'image'=>$getimageName
        );
        $id=$request->post('update');       
        $result=DB::table('about_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'About Details Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'About Details Update  Failed. Due To Internal Server Error..']); 
            return redirect()->back();
        }
    }
    
    public function delete_about($id)
    {
        
        $info_delete=DB::table('about_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'errmsg'=>'About Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'About Details Delete Failed ? Due To Internal Server Error...']); 
            return redirect()->back();
        }
    } 

    public function service()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['detail'] = DB::table('service_tb')->orderby('id','desc')->get();
        return view('admin/service')->with($data);
    }

    public function submit_service(Request $request)
    {
       
        request()->validate(
        [
            'heading' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);             
        $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
        $path = public_path('upload/service/'.$getimageName);
        $img = Image::make($request->file('image')->getRealPath())->save($path);
        $data=array(
            'heading'=>$request->post('heading'),
            'image'=>$getimageName
        );
        $result=DB::table('service_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Service Details Upload Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Service Details Upload Failed. Due To Internal Server Error..']); 
            return redirect()->back();
        }
    } 

    public function update_service(Request $request)
    {
       
        request()->validate(
        [
            'heading' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',

        ]);
        if(!empty($request->file('image')))
        {
            $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
            $path = public_path('upload/service/'.$getimageName);
            $img = Image::make($request->file('image')->getRealPath())->save($path);
        }
        else
        {
            $getimageName=$request->post('old_image');
        }
        
        $data=array(
            'heading'=>$request->post('heading'),
            'image'=>$getimageName
        );
        $id=$request->post('update');       
        $result=DB::table('service_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Service Details Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Service Details Update  Failed. Due To Internal Server Error..']); 
            return redirect()->back();
        }
    }
    
    public function delete_service($id)
    {
       
        $info_delete=DB::table('service_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'errmsg'=>'Service Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Service Details Delete Failed ? Due To Internal Server Error...']); 
            return redirect()->back();
        }
    } 
    
    public function banner()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['detail'] = DB::table('banner_tb')->orderby('id','desc')->get();
        return view('admin/slider')->with($data);
    }
    
    public function submit_banner(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'image' => $request->id ? 'nullable|image' : 'required|image',
        ]);
    
        $data = ['heading' => $request->heading];
    
        if ($request->hasFile('image')) {
            $filename = Str::random(10) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload/banner'), $filename);
            $data['image'] = $filename;
        } elseif ($request->id) {
            $data['image'] = $request->old_image;
        }
    
        if ($request->id) {
            DB::table('banner_tb')->where('id', $request->id)->update($data);
            Session::flash('message', 'Banner updated!');
        } else {
            DB::table('banner_tb')->insert($data);
            Session::flash('message', 'Banner added!');
        }
    
        return redirect()->back();
    }
    
    // public function update_banner(Request $request)
    // {
       
    //     request()->validate(
    //     [
    //         'heading' => 'required',
    //         'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
    //     ]);  

    //     if(!empty($files=$request->file('image')))
    //     {
    //         $getimageName = time().'.'.$request->image->getClientOriginalExtension();       
    //         $path = public_path('upload/banner/'.$getimageName);
    //         $img = Image::make($request->file('image')->getRealPath())->save($path);
    //     }
    //     else
    //     {
    //         $getimageName=$request->post('old_image');
    //     }

    //     $data=array(
    //         'heading'=>$request->post('heading'),
    //         'image'=>$getimageName,
    //     );
    //     $id=$request->post('update');       
    //     $result=DB::table('banner_tb')->where('id',$id)->update($data);
    //     if($result==true)
    //     {
    //         session(['message' =>'success', 'errmsg' =>'Banner Details Update Successfully...']);
    //         return redirect()->back();
    //     }
    //     else
    //     {
    //         session(['message' =>'danger', 'errmsg'=>'Banner Details Update   Failed. Due To Internal Server Error..']); 
    //         return redirect()->back();
    //     }
    // }
    
    public function delete_banner($id)
    {
        
        $info_delete=DB::table('banner_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'Banner Details Delete Successfully.']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Banner Details Delete Failed ? Due To Internal Server Error...']); 
            return redirect()->back();
        }
    }  
    
    public function addproducts()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['product'] = DB::table('product_tb')->orderby('id','desc')->get();
        $data['details'] = DB::table('subcategory_tb')->orderby('id','desc')->get();
        $data['cat'] = DB::table('category_tb')->orderby('id','desc')->get();
        return view('admin/addproducts')->with($data);
    }
  
    public function products()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['product'] = DB::table('product_tb')->orderby('id','desc')->get();
        $data['details'] = DB::table('subcategory_tb')->orderby('id','desc')->get();
        $data['cat'] = DB::table('category_tb')->orderby('id','desc')->get();
        return view('admin/products')->with($data);
    }
    
    public function show(Request $request)
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
    
    public function submit_product(Request $request)
    {   
        $details = DB::table('subscribe_tb')->get();
        $emails=array();
        foreach ($details as $key) 
        {
            $emails[]= $key->email;
        }

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
                    $message->to($emails)->subject('Mellow Elements');
                    foreach ($files as $file){
                        $message->attach($file); }
                    $message->from('info@mellowelements.in', 'Mellow Elements');
                    
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
                    $message->to($emails)->subject('Mellow Elements');
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
    
    public function product_updates($id)
    {  
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['product'] = DB::table('product_tb')->where('id',$id)->orderby('id','desc')->get();
        $data['details'] = DB::table('subcategory_tb')->orderby('id','desc')->get();
        $data['cat'] = DB::table('category_tb')->orderby('id','desc')->get();
        $data['subcategory_details'] = DB::table('subcategory_tb')->orderby('id','desc')->get();
        return view('admin/product_updates')->with($data);
    }
    
    public function update_product(Request $request)
    {
    
        request()->validate(
        [
            'subcategory_id' => 'required',
            'c_id' => 'required',
            'name' => 'required',
            'price' => 'required',          
        ]);  

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
          

           return redirect()->route('products');
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Product Details Update Failed. Due To Internal Server Error..']); 
            return redirect()->back();
        }
    }
    
    public function delete_product($id)
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
    
    public function contactus()
    {  
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get(); 
        $data['info'] = DB::table('contact_tbs')->orderby('id','desc')->get();
        return view('admin/contactus')->with($data);
    }

    public function all_rating()
    {  
       
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        
        $show['info_details'] = DB::table('rating_tb')
        ->select('product_tb.name','product_tb.image','product_tb.id','rating_tb.p_id','rating_tb.rating','rating_tb.date','rating_tb.ip')
        ->join('product_tb','product_tb.id', '=', 'rating_tb.p_id')
        ->get();

        return view('admin/all_rating')->with($show);
    }

     public function free_consultations()
    {  
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['free_consultation'] = DB::table('free_consultation_tb')->orderby('id','desc')->get();
        return view('admin/free_consultation')->with($data);
    }

    public function change_password()
    {
        
        return view('admin/change_password');
    }

    public function update_password(Request $request)
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        request()->validate(['con' => 'required','new' => 'required','old' => 'required']);
        
        $new=$request->post('new'); 
        $con=$request->post('con');
        $old=$request->post('old');
        if($new==$con)
        {   
            $use = DB::table('admin_tb')->where('pass_id','=',md5($old))->count();
            if($use > 0)
            {           
                $data=array('pass_id'=>md5($new),'show_pass'=>$new);
                $update_result=DB::table('admin_tb')->where('id',1)->update($data);
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
    
    public function privacy_policy()
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['privacy_policy'] = DB::table('privacy_policy_tb')->orderby('id','asc')->get();
        return view('admin/privacy_policy')->with($data);
    }
    
    public function submit_privacy_policy(Request $request)
    {   
       
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required',
        ]);

        $data=array(
           
            'heading'=>$request->post('heading'),
            'description'=>$request->post('description')
        );

        $result=DB::table('privacy_policy_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'Privacy Policy Added Successfully...', 'errmsg' =>'']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Privacy Policy Added Failed.']); 
            return redirect()->back();
        }
    }
    
    public function update_privacy_policy(Request $request)
    {
        
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required'
        ]);  

        $data=array(

            'heading'=>$request->post('heading'),
            'description'=>$request->post('description')
        );
        $id=$request->post('update');       
        $result=DB::table('privacy_policy_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'Privacy Policy Update Successfully...', 'errmsg' =>'']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Privacy Policy Update Failed.']); 
            return redirect()->back();
        }
    }
    
    public function delete_privacy_policy($id)
    {
        
        $info_delete=DB::table('privacy_policy_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'Privacy Policy Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Privacy Policy Delete Failed']); 
            return redirect()->back();
        }
    }  

    public function term_condition()
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['term_condition'] = DB::table('term_tb')->orderby('id','desc')->get();
        return view('admin/term_condition')->with($data);
    }
    
    public function submit_term_condition(Request $request)
    {   
        
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required',
        ]);

        $data=array(
           
            'heading'=>$request->post('heading'),
            'description'=>$request->post('description')
        );

        $result=DB::table('term_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'Term Condition Added Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Term Condition Added Failed.']); 
            return redirect()->back();
        }
    }
    
    public function update_term_condition(Request $request){
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required'
        ]);  

        $data=array(

            'heading'=>$request->post('heading'),
            'description'=>$request->post('description')
        );
        $id=$request->post('update');       
        $result=DB::table('term_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'Term Condition Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Term Condition Update Failed.']); 
            return redirect()->back();
        }
    }
    
    public function delete_term_condition($id)
    {
        $info_delete=DB::table('term_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'Term Condition Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Term Condition Delete Failed ? Due To Internal Server Error...']); 
            return redirect()->back();
        }
    } 

    public function add_contact()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['contact_details'] = DB::table('contact_details_tb')->orderby('id','desc')->get();
        return view('admin/add_contact')->with($data);
    } 
    
    public function submit_add_contact(Request $request)
    {   
        
        request()->validate(
        [
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $data=array(
           
            'address'=>$request->post('address'),
            'email'=>$request->post('email'),
            'phone'=>$request->post('phone'),
        );

        $result=DB::table('contact_details_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Contact Details Add Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Contact Details Added Failed.']); 
            return redirect()->back();
        }
    }
    
    public function update_add_contact(Request $request)
    {
       
        request()->validate(
        [
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);  

        $data=array(
            'address'=>$request->post('address'),
            'email'=>$request->post('email'),
            'phone'=>$request->post('phone'),
        );
        $id=$request->post('update');       
        $result=DB::table('contact_details_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Contact Details Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Contact Details Update Failed.']); 
            return redirect()->back();
        }
    }
    
    public function delete_add_contact($id)
    {
        
        $info_delete=DB::table('contact_details_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'errmsg'=>'Contact Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Contact Details Delete Failed ? Due To Internal Server Error...']); 
            return redirect()->back();
        }
    } 
    
    public function hig_prof()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        return view('admin/higher_professionals')->with($data);
    }
    
    public function submit_hig_prof(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);
    
        // Handle image upload without Intervention Image
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('upload/hig_prof'), $imageName);
    
        // Prepare data for insertion
        $data = [
            'heading' => $request->input('heading'),
            'image' => $imageName,
        ];
    
        $inserted = DB::table('higher_professional_tb')->insert($data);
    
        if ($inserted) {
            session()->flash('message', 'Higher Professional Added Successfully...');
        } else {
            session()->flash('message', 'Higher Professional Add Failed.');
        }
    
        return redirect()->back();
    }
    
    
    public function update_hig_prof(Request $request)
{
    $request->validate([
        'heading' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
    ]);

    $id = $request->post('update');
    $oldImage = $request->post('old_image');

    if ($request->hasFile('image')) {
        // Generate new image name
        $newImageName = time() . '.' . $request->image->getClientOriginalExtension();

        // Move new image to destination
        $request->image->move(public_path('upload/hig_prof'), $newImageName);

        // Remove old image file from folder (if exists)
        $oldImagePath = public_path('upload/hig_prof/' . $oldImage);
        if (file_exists($oldImagePath) && !empty($oldImage)) {
            @unlink($oldImagePath);
        }
    } else {
        // Use old image if new one is not uploaded
        $newImageName = $oldImage;
    }

    // Prepare update data
    $data = [
        'heading' => $request->input('heading'),
        'image' => $newImageName,
    ];

    $result = DB::table('higher_professional_tb')->where('id', $id)->update($data);

    if ($result) {
        session(['message' => 'Higher Professional Details Updated Successfully...']);
    } else {
        session(['message' => 'Higher Professional Details Update Failed.']);
    }

    return redirect()->back();
}

    
    public function delete_hig_prof($id)
    {
       
        $info_delete=DB::table('higher_professional_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'Higher Professional Details Delete Successfully.']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Higher Professional Details Delete Failed.']); 
            return redirect()->back();
        }
    }  

    public function requested_developer_details()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        
        $data['developer_details'] = DB::table('developer_details_tb')
        ->select('higher_professional_tb.id as ids','higher_professional_tb.heading','developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.description','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.total_hours','developer_details_tb.rating','developer_details_tb.address','developer_details_tb.language','developer_details_tb.education','developer_details_tb.skills','developer_details_tb.completed_job','developer_details_tb.portfolio_image','developer_details_tb.resume','developer_details_tb.developer_status','developer_details_tb.available_start_date','developer_details_tb.available_end_date','developer_details_tb.login_status','developer_details_tb.national_id_name','developer_details_tb.national_id_image','developer_details_tb.profile_complete','developer_details_tb.signature','developer_details_tb.clg_name','developer_details_tb.degree','developer_details_tb.percentage','developer_details_tb.passing_year','developer_details_tb.bank_name','developer_details_tb.branch_name','developer_details_tb.acct_name','developer_details_tb.account_number','developer_details_tb.ifc_code','developer_details_tb.micr_number','developer_details_tb.passbook','developer_details_tb.account_Type')
        ->join('higher_professional_tb','higher_professional_tb.id' , '=' , 'developer_details_tb.pro_id')
        ->where('developer_details_tb.login_status',0)
        ->orderby('developer_details_tb.dev_id','desc')
        ->get();

        $data['requested_project_details'] = DB::table('developer_project_details_tb')->get();

        return view('admin/requested_developer_details')->with($data);
    }

    public function active_developer_details()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        
        $data['developer_details'] = DB::table('developer_details_tb')
        ->select('higher_professional_tb.id as ids','higher_professional_tb.heading','developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.description','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.total_hours','developer_details_tb.rating','developer_details_tb.address','developer_details_tb.language','developer_details_tb.education','developer_details_tb.skills','developer_details_tb.completed_job','developer_details_tb.portfolio_image','developer_details_tb.resume','developer_details_tb.developer_status','developer_details_tb.available_start_date','developer_details_tb.available_end_date','developer_details_tb.login_status','developer_details_tb.clg_name','developer_details_tb.degree','developer_details_tb.percentage','developer_details_tb.passing_year','developer_details_tb.bank_name','developer_details_tb.branch_name','developer_details_tb.acct_name','developer_details_tb.account_number','developer_details_tb.ifc_code','developer_details_tb.micr_number','developer_details_tb.passbook','developer_details_tb.account_Type')
        ->join('higher_professional_tb','higher_professional_tb.id' , '=' , 'developer_details_tb.pro_id')
        ->where('developer_details_tb.login_status',1)
        ->orderby('developer_details_tb.dev_id','desc')
        ->get();

        $data['developer_project_details'] = DB::table('developer_project_details_tb')->get();

        return view('admin/active_developer_details')->with($data);
    }

    public function developer_details()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        
        $data['developer_details'] = DB::table('developer_details_tb')
        ->select('higher_professional_tb.id as ids','higher_professional_tb.heading','developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.description','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.total_hours','developer_details_tb.rating','developer_details_tb.address','developer_details_tb.language','developer_details_tb.education','developer_details_tb.skills','developer_details_tb.completed_job','developer_details_tb.portfolio_image','developer_details_tb.resume','developer_details_tb.developer_status','developer_details_tb.available_start_date','developer_details_tb.available_end_date','developer_details_tb.login_status','developer_details_tb.clg_name','developer_details_tb.degree','developer_details_tb.percentage','developer_details_tb.passing_year','developer_details_tb.bank_name','developer_details_tb.branch_name','developer_details_tb.acct_name','developer_details_tb.account_number','developer_details_tb.ifc_code','developer_details_tb.micr_number','developer_details_tb.passbook','developer_details_tb.account_Type')
        ->join('higher_professional_tb','higher_professional_tb.id' , '=' , 'developer_details_tb.pro_id')
        ->where('developer_details_tb.login_status',1)
        ->orderby('developer_details_tb.dev_id','desc')
        ->get();

        $data['developer_project_details'] = DB::table('developer_project_details_tb')->get();

        return view('admin/developer_details')->with($data);
    }

    
    public function submit_developer_details(Request $request)
{   
    $email = $request->post('email');
    
    $count = DB::table('developer_details_tb')->where('email', $email)->count();
    
    if ($count == 0) {
        request()->validate([
            'pro_id' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'description' => 'required',
            'job' => 'required',
            'total_hours' => 'required',
            'perhr' => 'required',
            'rating' => 'required',
            'address' => 'required',
            'language' => 'required',
            'education' => 'required',
            'clg_name' => 'required',
            'degree' => 'required',
            'percentage' => 'required',
            'passing_year' => 'required',
            'skills' => 'required',
            'completed_job' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
            'portfolio_image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
            'resume' => ['required', 'mimes:pdf', 'max:1024000'] // max 1000MB in KB
        ]);

        // Upload profile image
        $getimageName = time() . '_profile.' . $request->image->getClientOriginalExtension();       
        $request->image->move(public_path('upload/developer'), $getimageName);

        // Upload portfolio image
        $getportfolioimage = time() . '_portfolio.' . $request->portfolio_image->getClientOriginalExtension();       
        $request->portfolio_image->move(public_path('upload/portfolio'), $getportfolioimage);  

        // Upload resume
        $getresume = null;
        if ($request->hasFile('resume')) {
            $new_name = rand() . '.' . $request->resume->getClientOriginalExtension();
            $request->resume->move(public_path('upload/resume'), $new_name); 
            $getresume = 'upload/resume/' . $new_name;
        }

        // Implode education fields
        $education = implode(',', $request->post('education'));
        $clg_name = implode(',', $request->post('clg_name'));
        $degree = implode(',', $request->post('degree'));
        $percentage = implode(',', $request->post('percentage'));
        $passing_year = implode(',', $request->post('passing_year'));

        $data = [
            'pro_id' => $request->post('pro_id'),
            'name' => $request->post('name'),
            'last_name' => $request->post('last_name'),
            'phone' => $request->post('phone'),
            'email' => $request->post('email'),
            'password' => md5($request->post('password')),
            'show_password' => $request->post('password'),
            'description' => $request->post('description'),
            'job' => $request->post('job'),
            'total_hours' => $request->post('total_hours'),
            'perhr' => $request->post('perhr'),
            'rating' => $request->post('rating'),
            'address' => $request->post('address'),
            'language' => $request->post('language'),
            'education' => $education,
            'clg_name' => $clg_name,
            'degree' => $degree,
            'percentage' => $percentage,
            'passing_year' => $passing_year,
            'skills' => $request->post('skills'),
            'completed_job' => $request->post('completed_job'),
            'image' => $getimageName,
            'portfolio_image' => $getportfolioimage,
            'resume' => $getresume,
            'profile_complete' => 100,
            'login_status' => 1,
            'date' => date('y/m/d')
        ];

        $result = DB::table('developer_details_tb')->insert($data);

        if ($result) {
            $details = DB::table('developer_details_tb')->where('email', $email)->first();

            $emails = [$details->email];
            $datas = [
                'name' => $details->name,
                'email' => $details->email,
                'show_password' => $details->show_password,
                'link' => route('developer_admin')
            ];

            session(['message' => 'Developer Details Added Successfully...']);

            Mail::send('developer_add_mail', $datas, function ($message) use ($emails) {
                $message->to($emails)->subject('Mellow Elements');
                $message->from('dev@mellowelements.in', 'Mellow Elements');
            });

            return redirect()->route('active_developer_details');
        } else {
            session(['message' => 'Developer Details Added Failed.']); 
            return redirect()->back();
        }
    } else {
        session(['message' => 'Email Address Already Exists.']);
        return redirect('hig_prof');
    }
}

    
    public function developer_details_update($dev_id)
    {  
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $data['developer_details'] = DB::table('developer_details_tb')
        ->select('higher_professional_tb.id as ids','higher_professional_tb.heading','developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.description','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.total_hours','developer_details_tb.rating','developer_details_tb.address','developer_details_tb.language','developer_details_tb.education','developer_details_tb.skills','developer_details_tb.completed_job','developer_details_tb.portfolio_image','developer_details_tb.resume','developer_details_tb.available_start_date','developer_details_tb.available_end_date','developer_details_tb.login_status','developer_details_tb.clg_name','developer_details_tb.degree','developer_details_tb.percentage','developer_details_tb.passing_year')
        ->join('higher_professional_tb','higher_professional_tb.id' , '=' , 'developer_details_tb.pro_id')
        ->where('dev_id',$dev_id)
        ->orderby('id','desc')->get();
        return view('admin/developer_details_update')->with($data);
    }
    
    

public function update_developer_details(Request $request)
{
    $request->validate([
        'pro_id' => 'required',
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
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
        'portfolio_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
        'resume' => 'nullable|mimes:pdf|max:1024000', // 1000MB = 1,000,000KB
    ]);

    $dev_id = $request->post('update');

    $developer = DB::table('developer_details_tb')->where('dev_id', $dev_id)->first();

    // Upload image
    if ($request->hasFile('image')) {
        if ($developer->image && File::exists(public_path('upload/developer/' . $developer->image))) {
            File::delete(public_path('upload/developer/' . $developer->image));
        }
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('upload/developer'), $imageName);
    } else {
        $imageName = $developer->image;
    }

    // Upload portfolio image
    if ($request->hasFile('portfolio_image')) {
        if ($developer->portfolio_image && File::exists(public_path('upload/portfolio/' . $developer->portfolio_image))) {
            File::delete(public_path('upload/portfolio/' . $developer->portfolio_image));
        }
        $portfolioImage = time() . '_p.' . $request->portfolio_image->getClientOriginalExtension();
        $request->portfolio_image->move(public_path('upload/portfolio'), $portfolioImage);
    } else {
        $portfolioImage = $developer->portfolio_image;
    }

    // Upload resume
    if ($request->hasFile('resume')) {
        if ($developer->resume && File::exists(public_path('upload/resume/' . $developer->resume))) {
            File::delete(public_path('upload/resume/' . $developer->resume));
        }
        $resumeName = time() . '.' . $request->resume->getClientOriginalExtension();
        $request->resume->move(public_path('upload/resume'), $resumeName);
    } else {
        $resumeName = $developer->resume;
    }

    $data = [
        'pro_id' => $request->post('pro_id'),
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
        'image' => $imageName,
        'portfolio_image' => $portfolioImage,
        'resume' => $resumeName,
    ];

    $result = DB::table('developer_details_tb')->where('dev_id', $dev_id)->update($data);

    if ($result) {
        session(['message' => 'Developer Details Updated Successfully...']);
        return redirect()->route('active_developer_details');
    } else {
        session(['message' => 'Developer Details Update Failed.']);
        return redirect()->back();
    }
}

    
    public function delete_developer_details($dev_id)
    {
        
        $info_delete=DB::table('developer_details_tb')->where('dev_id', $dev_id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'errmsg'=>'Developer Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Developer Details Delete Failed.']); 
            return redirect()->back();
        }
    } 

    public function developer_available_update(Request $request)
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
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

            return redirect()->route('developer_details');
            // return view('admin/')->with($data);
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Available Date Update Failed.']); 
            return redirect()->back();
        }
    }

    public function developer_login_status($dev_id)
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $devLogin = DB::table('developer_details_tb')->where('dev_id',$dev_id)->first();
        
        
        if (!$devLogin) {
            session(['message' => 'danger', 'errmsg' => 'Developer not found.']);
            return redirect()->back();
        }
    
        // Check if trying to activate and profile is incomplete
        if ($devLogin->login_status == 0 && $devLogin->profile_complete < 100) {
            $emails = [$devLogin->email];
            $datas = [
                'email' => $devLogin->email,
                'show_password' => $devLogin->show_password,
                'name' => $devLogin->name
            ];
    
            // Send incomplete profile email
            $messageBody = "Dear {$devLogin->name},\n\nYour profile is incomplete. Please complete your profile including KYC, bank details, and other required information to activate your account.\n\nThank you,\nMellow Voult";

            Mail::raw($messageBody, function ($message) use ($devLogin) {
                $message->to($devLogin->email)
                        ->subject('Complete Your Profile – Mellow Voult')
                        ->from('dev@mellowelements.in', 'Mellow Voult');
            });
    
            session(['message' => 'warning', 'errmsg' => 'Cannot activate developer. Profile is incomplete. Email sent to user.']);
            return redirect()->back();
        }
        $count = DB::table('premium_order_tb')->where('dev_id',$devLogin->dev_id)->count();
        
        if($count == 0)
        {
            session(['message' =>'danger', 'errmsg'=>'The developer has not purchased a premium package.']); 
             return redirect()->back();
        }

        $Login_status = $devLogin->login_status;
        
        // call new panels api for saving active developer
        $payload = [
            'job_id' => 1,
            'full_name' => $devLogin->name,
            'email' => $devLogin->email,
            'phone' => $devLogin->phone,
            'source' => 1,
            'resume' => 'Na',
            'remark' => 'Na',
            'recruit_job_id' => 1,
            'location_id' => 1,
            'application_sources' => 'addedByUser'
        ];
        $url = env('URL').'/api/job-applications';
        $response = Http::withoutVerifying()->post($url, $payload);
            
        $emails=array();
        
        $emails[]= $devLogin->email;
        $email= $devLogin->email;
        $show_password= $devLogin->show_password;
        $name= $devLogin->name;
        
        $datas=array(
            'email'=>$email,
            'show_password'=>$show_password,
            'name'=>$name
        );

        if( $Login_status == 1){

            $data=array(
                'login_status'=>0,
            );
        
            $info_delete=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
            if($info_delete==true)
            {
                session(['message' =>'success', 'errmsg'=>'Developer Deactivate Successfully. ']); 

                Mail::send('deactivate_mail', $datas, function($message) use ($emails) {
                    $message->to($emails)->subject('Mellow Elements');
                    $message->from('dev@mellowelements.in', 'Mellow Elements');
                });
                return redirect()->back();
            }
            else
            {
                session(['message' =>'danger', 'errmsg'=>'Developer Not Deactivate.']); 
                return redirect()->back();
            }
        }else{

            $data=array(
                'login_status'=>1,
                'developer_status'=>"Active",
            );
        
            $info_delete=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
            if($info_delete==true)
            {
                session(['message' =>'success', 'errmsg'=>'Developer Activate Successfully. ']); 

                Mail::send('activate_mail', $datas, function($message) use ($emails) {
                    $message->to($emails)->subject('Mellow Elements');
                    $message->from('dev@mellowelements.in', 'Mellow Elements');
                });
                return redirect()->back();
            }
            else
            {
                session(['message' =>'danger', 'errmsg'=>'Developer Not Activate.']); 
                return redirect()->back();
            }
        }
    } 
    
    // this function is working for insert developer in jop_applications table but not need now 
    //  public function developer_login_status($dev_id)
    // {
    //     $email = Session::get('admin_login_role');
    //     $data['rolesdetails'] = DB::table('admin_tb')->where('role', $email)->get();
    //     $devLogin = DB::table('developer_details_tb')->where('dev_id', $dev_id)->first();
    
    //     $payload = [
    //         'job_id' => 1,
    //         'full_name' => $devLogin->name,
    //         'email' => $devLogin->email,
    //         'phone' => $devLogin->phone,
    //         'source' => 1,
    //         'resume' => 'Na',
    //         'remark' => 'Na',
    //         'recruit_job_id' => 1,
    //         'location_id' => 1,
    //         'application_sources' => 'addedByUser'
    //     ];
    
    //     $response = Http::withoutVerifying()->post('https://gulbug.com/staging/mellow_backend/public/api/job-applications', $payload);
    
    //     if ($response->successful()) {
    //         session(['message' => 'success', 'errmsg' => 'Developer submitted to job application API successfully.']);
    //     } else {
    //         session(['message' => 'danger', 'errmsg' => 'API call failed: ' . $response->body()]);
    //     }
    
    //     return redirect()->back();
    // }
    
    public function developer_approve_status($dev_id)
    {
        
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $devappLogin = DB::table('developer_interview_schedule')->where('dev_id',$dev_id)->first();

        $Approve_status = $devappLogin->status;

        $emails=array();
        
        $emails[]= $devappLogin->email;
        $email= $devappLogin->email;
        
        $datas=array(
            'email'=>$email,
        );

        if( $Approve_status == 1){

            $data=array(
                'status'=>Qualified,
            );
        
            $info_delete=DB::table('developer_interview_schedule')->where('dev_id',$dev_id)->update($data);
            $info_delete=DB::table('developer_order_tb')->where('dev_id',$dev_id)->update($data);
            
            if($info_delete==true)
            {
                session(['message' =>'success', 'errmsg'=>'Interview Not Approved Successfully. ']); 

                Mail::send('approve_deactivate_mail', $datas, function($message) use ($emails) {
                    $message->to($emails)->subject('Mellow Elements');
                    $message->from('info@mellowelements.in', 'Mellow Elements');
                });
                return redirect()->back();
            }
            else
            {
                session(['message' =>'danger', 'errmsg'=>'Interview Not Approved.']); 
                return redirect()->back();
            }
        }else{
            $data=array(
                'status'=>1,
            );
        
            $info_delete=DB::table('developer_interview_schedule')->where('dev_id',$dev_id)->update($data);
            $info_delete=DB::table('developer_order_tb')->where('dev_id',$dev_id)->update($data);
            
            if($info_delete==true)
            {
                session(['message' =>'success', 'errmsg'=>'Interview Approved Successfully. ']); 

                Mail::send('approve_activate_mail', $datas, function($message) use ($emails) {
                    $message->to($emails)->subject('Mellow Elements');
                    $message->from('info@mellowelements.in', 'Mellow Elements');
                });
                return redirect()->back();
            }
            else
            {
                session(['message' =>'danger', 'errmsg'=>'Developer Not Activate.']); 
                return redirect()->back();
            }
        }
    }

    public function developer_project_details()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['all_developer_details'] = DB::table('developer_details_tb')->orderby('dev_id','desc')->get();
        //$data['developer_project_details'] = DB::table('developer_project_details_tb')->get();


        $data['developer_project_details'] = DB::table('developer_project_details_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.name','developer_project_details_tb.developer_id','developer_project_details_tb.screenshot_image','developer_project_details_tb.project_link','developer_project_details_tb.id','developer_details_tb.available_start_date','developer_details_tb.available_end_date')
        ->join('developer_details_tb','developer_details_tb.dev_id' , '=' , 'developer_project_details_tb.developer_id')
        ->get();


        return view('admin/developer_project_details')->with($data);
    } 

    public function submit_developer_project_details(Request $request)
    {   
        $request->validate([
            'developer_id' => 'required',
            'project_link' => 'required',
            'screenshot_image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);
    
        $image = $request->file('screenshot_image');
        $imageName = time().'.'.$image->getClientOriginalExtension();       
        $image->move(public_path('upload/screenshot'), $imageName);
    
        $data = [
            'developer_id' => $request->post('developer_id'),
            'project_link' => $request->post('project_link'),
            'screenshot_image' => $imageName,
        ];
    
        $result = DB::table('developer_project_details_tb')->insert($data);
    
        session(['message' => $result ? 'Developer Project Details Added Successfully...' : 'Developer Project Details Added Failed.']);
        return redirect()->back();
    }
    

    public function update_developer_project_details(Request $request)
    {
        $request->validate([
            'developer_id' => 'required',
            'project_link' => 'required',            
            'screenshot_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);  
    
        $id = $request->post('update');
        $oldImage = $request->post('old_screenshot_image');
        $imageName = $oldImage;
    
        if ($request->hasFile('screenshot_image')) {
            // Delete old image
            $oldPath = public_path('upload/screenshot/'.$oldImage);
            if (file_exists($oldPath) && is_file($oldPath)) {
                unlink($oldPath);
            }
    
            // Upload new image
            $image = $request->file('screenshot_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();       
            $image->move(public_path('upload/screenshot'), $imageName);
        }
    
        $data = [
            'developer_id' => $request->post('developer_id'),
            'project_link' => $request->post('project_link'),
            'screenshot_image' => $imageName,
        ];
    
        $result = DB::table('developer_project_details_tb')->where('id', $id)->update($data);
    
        session(['message' => $result ? 'Developer Project Details Update Successfully...' : 'Developer Project Details Update Failed.']);
        return redirect()->back();
    }
    

    public function delete_developer_project_details($developer_id)
    {
       
        $info_delete=DB::table('developer_project_details_tb')->where('developer_id', $developer_id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'errmsg'=>'Developer Project Details Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Developer Project Details Delete Failed.']); 
            return redirect()->back();
        }
    } 

    public function License()
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['License'] = DB::table('license_tb')->orderby('id','desc')->get();
        return view('admin/License')->with($data);
    }
    
    public function submit_License(Request $request)
    {   
      
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required',
        ]);

        $data=array(
           
            'heading'=>$request->post('heading'),
            'description'=>$request->post('description')
        );

        $result=DB::table('license_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'License Saved Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'License Added Failed.']); 
            return redirect()->back();
        }
    }
    
    public function update_License(Request $request)
    {
       
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required'
        ]);  

        $data=array(

            'heading'=>$request->post('heading'),
            'description'=>$request->post('description')
        );
        $id=$request->post('update');       
        $result=DB::table('license_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'License Updated Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'License Update Failed.']); 
            return redirect()->back();
        }
    }
    
    public function delete_License($id)
    {
        $info_delete=DB::table('license_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'License Deleted Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'License Delete Failed']); 
            return redirect()->back();
        }
    }  

    public function blog()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
  
        $data['blog_detail'] = DB::table('blog_tb')->orderby('id','desc')->get();
        return view('admin/blog')->with($data);
    }
    
    public function submit_blog(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'description' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            // 'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);  
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $getimageblog = time().'.'.$image->getClientOriginalExtension();       
            $image->move(public_path('upload/blog/'), $getimageblog);
        } else {
            $getimageblog = $request->post('image');
        }
    
        $data = [
            'heading' => $request->post('heading'),
            'description' => $request->post('description'),
            'day' => $request->post('day'),
            'month' => $request->post('month'),
            'year' => $request->post('year'),
            'image' => $getimageblog,
        ];           
    
        $result = DB::table('blog_tb')->insert($data);
    
        if ($result) {
            session(['message' => 'Blogs Upload Successfully!..']);
        } else {
            session(['message' => 'Blogs Upload Failed.']);
        }
    
        return redirect()->back();
    }

    
    public function update_blog(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'description' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            // 'image' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $getimageblog = time().'.'.$image->getClientOriginalExtension();       
            $image->move(public_path('upload/blog/'), $getimageblog);
        } else {
            $getimageblog = $request->post('image');
        }
    
        $data = [
            'heading' => $request->post('heading'),
            'description' => $request->post('description'),
            'day' => $request->post('day'),
            'month' => $request->post('month'),
            'year' => $request->post('year'),
            'image' => $getimageblog,
        ];
    
        $id = $request->post('update');       
        $result = DB::table('blog_tb')->where('id', $id)->update($data);
    
        if ($result) {
            session(['message' => 'Blogs Update Successfully...']);
        } else {
            session(['message' => 'Blogs Details Update Failed.']);
        }
    
        return redirect()->back();
    }

    
    public function delete_blog($id)
    {
        $info_delete=DB::table('blog_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'Blogs Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Blogs Delete Failed ?']); 
            return redirect()->back();
        }
    } 
    
    public function faqs()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['faq_detail'] = DB::table('faq_tb')->orderby('id','desc')->get();
        return view('admin/faqs')->with($data);
    }

    public function submit_faqs(Request $request)
    {
       
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required',
            
        ]);  

        $data=array(
            'heading'=>$request->post('heading'),
            'description'=>$request->post('description'),
        );           
        
        $result=DB::table('faq_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'All Questions Upload Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Questions Details Upload Failed.']); 
            return redirect()->back();
        }
    } 

    public function update_faqs(Request $request)
    {
        
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required',
        ]);
        
        $data=array(
            'heading'=>$request->post('heading'),
            'description'=>$request->post('description'),
        );
        $id=$request->post('update');       
        $result=DB::table('faq_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'All Questions Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'All Questions Details Update Failed.']); 
            return redirect()->back();
        }
    }
    
    public function delete_faqs($id)
    {
        $info_delete=DB::table('faq_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'All Questions Delete Successfully.']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'All Questions Delete Failed ?']); 
            return redirect()->back();
        }
    } 
    
    public function customer_details()
    {   
        $email= Session::get('admin_login_role');
        $show['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $show['customer'] = DB::table('order_tb')->orderby('id','desc')->get();
        return view('admin/customer_details')->with($show);
    }
    
    public function product_order()
    {   
        $email= Session::get('admin_login_role');
        $show['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $show['product_order_details'] = DB::table('order_tb')
        ->select('product_tb.name','product_tb.image','product_tb.id','product_tb.price','product_tb.video','order_tb.p_id','order_tb.order_id','order_tb.payment_status','order_tb.date','order_tb.u_id','order_tb.fname')
        ->join('product_tb','product_tb.id', '=', 'order_tb.p_id')
        ->orderby('id','desc')
        ->get();

        $show['transaction_details'] = DB::table('payment_tb')->groupBy('order_id')->get();

        return view('admin/product_order')->with($show);
    }
    
    public function developer_order()
    {   
        $email= Session::get('admin_login_role');
        $show['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $show['developer_order_details'] = DB::table('developer_order_tb')
        ->select('developer_details_tb.name','developer_details_tb.image','developer_details_tb.dev_id','developer_details_tb.perhr','developer_order_tb.dev_id','developer_order_tb.order_id','developer_order_tb.payment_status','developer_order_tb.date','developer_order_tb.u_id','developer_order_tb.fname')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->orderby('id','desc')
        ->get();
        return view('admin/developer_order')->with($show);
    }

    public function developer_status(Request $request)
    {   
        
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $developer_status = $request->post('developer_status');
        $dev_id = $request->post('dev_id');

        $data=array(
            'developer_status'=>$developer_status,
        );            
        
        $result = DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);

        $data=array(
            'payment_status'=>'NULL',
        ); 

        $result = DB::table('developer_order_tb')->where('dev_id',$dev_id)->update($data);
        
        if($result == true){
            echo "Status Update!!";
        }else{
            echo "Status Not Update!!";
        } 
    }

    public function web_setting()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['web_detail'] = DB::table('web_setting')->orderby('id','asc')->get();
        return view('admin/web_setting')->with($data);
    }

    public function update_web_setting(Request $request)
    {
        
        request()->validate(
        [
            'fb' => 'required',
            'twitter' => 'required',
            'insta' => 'required',
            'linkedin' => 'required',          
            'header_logo' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
            'footer_logo' => 'image|mimes:jpg,png,jpeg,gif|max:5120',
            
        ]);
        if(!empty($request->file('header_logo')))
        {
            $getimageheaderlogo = time().'.'.$request->header_logo->getClientOriginalExtension();       
            $path = public_path('upload/header/'.$getimageheaderlogo);
            $img = Image::make($request->file('header_logo')->getRealPath())->save($path);
        }
        else
        {
            $getimageheaderlogo=$request->post('old_header_logo');
        } 

        if(!empty($request->file('footer_logo')))
        {
            $getimagefooterlogo = time().'.'.$request->footer_logo->getClientOriginalExtension();       
            $path = public_path('upload/footer/'.$getimagefooterlogo);
            $img = Image::make($request->file('footer_logo')->getRealPath())->save($path);
        }
        else
        {
            $getimagefooterlogo=$request->post('old_footer_logo');
        }  

        $data=array(
            'fb'=>$request->post('fb'),
            'twitter'=>$request->post('twitter'),
            'insta'=>$request->post('insta'),
            'linkedin'=>$request->post('linkedin'),               
            'header_logo'=>$getimageheaderlogo,
            'footer_logo'=>$getimagefooterlogo,
        );
        $id=$request->post('update');       
        $result=DB::table('web_setting')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'weberrmsg' =>'Web Details Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'weberrmsg'=>'Web Details Update Failed.']); 
            return redirect()->back();
        }
    }

    public function resoure_details()
    {   
       
       $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
       // $data['require_docs_details'] = DB::table('require_docs_tb')->orderby('id','desc')->get();

        $data['resoure_details'] = DB::table('developer_order_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.address','developer_details_tb.phone as dev_phone','developer_details_tb.job','developer_details_tb.total_hours','developer_details_tb.perhr','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.education','developer_details_tb.description','developer_details_tb.skills','developer_details_tb.completed_job','developer_details_tb.image','developer_details_tb.portfolio_image','developer_details_tb.resume','developer_details_tb.date','developer_order_tb.fname','developer_order_tb.lname','developer_order_tb.dev_id','developer_order_tb.phone','developer_order_tb.address_one','developer_order_tb.email','developer_order_tb.u_id','developer_order_tb.country','developer_order_tb.state','developer_order_tb.city','developer_order_tb.payment_status')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->get();

        return view('admin/resoure_details')->with($data);
    }


    public function require_docs_details($u_id,$dev_id)
    {   
        
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['require_docs_details'] = DB::table('require_docs_tb')->where('u_id',$u_id)->where('dev_id',$dev_id)->orderby('id','desc')->get();

        /*$data['require_docs_details'] = DB::table('require_docs_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.address as dev_address','developer_details_tb.phone as dev_phone','require_docs_tb.fname','require_docs_tb.lname','require_docs_tb.dev_id','require_docs_tb.phone','require_docs_tb.address','require_docs_tb.email','require_docs_tb.require_docs','require_docs_tb.date','require_docs_tb.id','require_docs_tb.subject')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'require_docs_tb.dev_id')
        ->orderby('require_docs_tb.id','desc')
        ->get();*/

        return view('admin/require_docs')->with($data);
    }

    public function require_download($id)
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $details = DB::table('require_docs_tb')->where('id','=',$id)->first();
                   
        $file = $details->require_docs;
        $myFile = public_path('upload/require/'.$file);
        return response()->download($file); 

    }

    public function short_message_details($u_id,$dev_id)
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['short_message_details'] = DB::table('short_message_tb')->where('u_id',$u_id)->where('dev_id',$dev_id)->orderby('id','desc')->get();

        /*$data['short_message_details'] = DB::table('short_message_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.address as dev_address','developer_details_tb.phone as dev_phone','short_message_tb.fname','short_message_tb.lname','short_message_tb.dev_id','short_message_tb.phone','short_message_tb.address','short_message_tb.email','short_message_tb.subject','short_message_tb.description','short_message_tb.date','short_message_tb.id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'short_message_tb.dev_id')
        ->orderby('short_message_tb.id','desc')
        ->get();*/

        return view('admin/short_message')->with($data);
    }
    
    public function sow_details($u_id,$dev_id)
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['sow_details'] = DB::table('sow_tb')->where('u_id',$u_id)->where('dev_id',$dev_id)->orderby('id','desc')->get();

        /*$data['sow_details'] = DB::table('sow_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.address as dev_address','developer_details_tb.phone as dev_phone','sow_tb.fname','sow_tb.lname','sow_tb.dev_id','sow_tb.phone','sow_tb.address','sow_tb.email','sow_tb.sow_docs','sow_tb.date','sow_tb.id','sow_tb.subject')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'sow_tb.dev_id')
        ->orderby('sow_tb.id','desc')
        ->get();*/

        return view('admin/sow')->with($data);
    }

    public function sow_download($id)
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $details = DB::table('sow_tb')->where('id','=',$id)->first();
        $file = $details->sow_docs;
        $myFile = public_path('upload/sow/'.$file);
        return response()->download($file); 
    }

    public function sow_project_details($sow_id)
    {   
        
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['sow_pro_details'] = DB::table('project_details_tb')->where('sow_id',$sow_id)->get();

        return view('admin/sow_project_details')->with($data);
    }

    public function live_chat()
    {   
        $data['details'] = DB::table('chat_tb')
        ->select('user_login.image','chat_tb.u_id','chat_tb.user_name','chat_tb.message')
        ->join('user_login','user_login.id', '=', 'chat_tb.u_id')
        ->get();

        $data['chat_details'] = DB::table('chat_tb')->get();

        return view('admin/live_chat')->with($data);
        
    }

    public function refund()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['refund_policy'] = DB::table('refund_tb')->orderby('id','asc')->get();
        return view('admin/refund')->with($data);
    }
    
    public function submit_refund(Request $request)
    {   
       
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required',
        ]);

        $data=array(
           
            'heading'=>$request->post('heading'),
            'description'=>$request->post('description')
        );

        $result=DB::table('refund_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'Refund Added Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Refund Added Failed.']); 
            return redirect()->back();
        }
    }
    
    public function update_refund(Request $request)
    {
        
        request()->validate(
        [
            'heading' => 'required',
            'description' => 'required'
        ]);  

        $data=array(

            'heading'=>$request->post('heading'),
            'description'=>$request->post('description')
        );
        $id=$request->post('update');       
        $result=DB::table('refund_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'Refund Policy Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Refund Policy Update Failed.']); 
            return redirect()->back();
        }
    }
    
    public function delete_refund($id)
    {
        
        $info_delete=DB::table('refund_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'Refund Policy Delete Successfully.']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Refund Policy Delete Failed']); 
            return redirect()->back();
        }
    } 

    public function all_visitor()
    {  
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['details'] = DB::table('visitor_tb')
            ->select(DB::raw('DATE(date) as date'), DB::raw('count(ip) as ip'))
            ->groupBy('date')
            ->get();
        return view('admin/all_visitor')->with($data);
    }

    public function requested_developer_profile_details($dev_id)
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['developer_profile_details'] = DB::table('developer_details_tb')->where('dev_id',$dev_id)->get();
        return view('admin/requested_developer_profile_details')->with($data);
    }

    public function requested_bank_details($dev_id)
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['requested_bank_details'] = DB::table('developer_details_tb')->where('dev_id',$dev_id)->get();
        return view('admin/requested_bank_details')->with($data);
    }

    public function requested_project_details($dev_id)
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['requested_project_details'] = DB::table('developer_project_details_tb')->where('developer_id',$dev_id)->get();
        return view('admin/requested_project_details')->with($data);
    }

    public function education_updates_details($dev_id)
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['develoeper_education_details'] = DB::table('developer_details_tb')->where('dev_id',$dev_id)->get();
        return view('admin/education_updates_details')->with($data);
    }

    public function education_updates(Request $request)
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
        );

        $dev_id=$request->post('dev_id');       
        $result=DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Developer Details Update Successfully...']);
           return redirect()->route('developer_details');
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Developer Details Update Failed.']); 
            return redirect()->back();
        }
    }

    public function developer_transaction_details($dev_id)
    {   
        $email= Session::get('admin_login_role');
        $show['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $show['wallet_details']= DB::table('wallet_tb')->where('dev_id',$dev_id)->get();
        $show['developer_payment_details']= DB::table('developer_payment_transfer_tb')->where('dev_id',$dev_id)->orderby('id','desc')->get();
        
        return view('admin/developer_transaction_details')->with($show);
        
    }

    public function checkout_to_developer($id)
    {  
        $email= Session::get('admin_login_role');
        $show['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $show['developer_details']= DB::table('developer_details_tb')
        ->select('wallet_tb.id','wallet_tb.order_id','wallet_tb.original_price','wallet_tb.dev_id','wallet_tb.transaction_status','developer_details_tb.dev_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.address','developer_details_tb.phone','developer_details_tb.email')
        ->join('wallet_tb','wallet_tb.dev_id', '=', 'developer_details_tb.dev_id')
        ->where('wallet_tb.transaction_status',0)
        ->where('wallet_tb.id',$id)
        ->get();

        return view('admin/checkout_to_developer')->with($show);
    }

    public function payment_initiate_to_developer(Request $request ,$id)
    {
        $order_id= Session::get('order_id');
        $email= Session::get('admin_login_role');
        $show['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();

        $show['developer_details']= DB::table('developer_details_tb')
        ->select('wallet_tb.id','wallet_tb.order_id','wallet_tb.original_price','wallet_tb.dev_id','wallet_tb.transaction_status','developer_details_tb.dev_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.address','developer_details_tb.phone','developer_details_tb.email')
        ->join('wallet_tb','wallet_tb.dev_id', '=', 'developer_details_tb.dev_id')
        ->where('wallet_tb.transaction_status',0)
        ->where('wallet_tb.id',$id)
        ->get();

        $developer_details= DB::table('developer_details_tb')
        ->select('wallet_tb.p_id','wallet_tb.id','wallet_tb.order_id','wallet_tb.original_price','wallet_tb.dev_id','wallet_tb.transaction_status','developer_details_tb.dev_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.address','developer_details_tb.phone','developer_details_tb.email')
        ->join('wallet_tb','wallet_tb.dev_id', '=', 'developer_details_tb.dev_id')
        ->where('wallet_tb.transaction_status',0)
        ->where('wallet_tb.id',$id)
        ->first();

        $wallet_id = $developer_details->id;
        $wallet_p_id = $developer_details->p_id;

        $name = $request->post('name');
        $last_name = $request->post('last_name');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $address = $request->post('address');

        session(['wallet_id' => $wallet_id]);
        session(['wallet_p_id' => $wallet_p_id]);
        session(['name' => $name]);
        session(['last_name' => $last_name]);
        session(['email' => $email]);
        session(['phone' => $phone]);
        session(['address' => $address]);
       
       $order_id= Session::get('order_id');

       $amount= Session::get('original_price');
                
        $final=$amount;     
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
            'name' =>$name,
            'last_name' =>$last_name,             
            'email' => $email,
            'phone' =>$phone,
            'address' =>$address,
            'description' => 'Payment Transfer',
        ];
       
        // Let's checkout payment page is it working    
    return view('admin/developer_payment',compact('response'))->with($show);
    }

    public function amount_transfer(Request $request)
    { 
       
        $name=Session::get('name');
        $last_name=Session::get('last_name');
        $email=Session::get('email');
        $phone=Session::get('phone');
        $dev_id= Session::get('dev_id');
        $address=Session::get('address');
        $order_id= Session::get('order_id');
        $amount= Session::get('original_price');
        $wallet_id= Session::get('wallet_id');
        $wallet_p_id= Session::get('wallet_p_id');

        $signatureStatus = $this->SignatureVerify(
            $request->all()['rzp_signature'],
            $request->all()['rzp_paymentid'],
            $request->all()['rzp_orderid']
        );
        // If Signature status is true We will save the payment response in our database
        // In this tutorial we send the response to Success page if payment successfully made
        if($signatureStatus == true)
        {
                    $order_data=array(
                    'fname'=>$name,
                    'lname'=>$last_name,
                    'email'=>$email,
                    'phone'=>$phone,
                    'address'=>$address,
                    'wallet_id'=>$wallet_id,
                    'wallet_p_id'=>$wallet_p_id,
                    'order_id'=>$order_id,
                    'dev_id'=>$dev_id,
                    'price'=>$amount,
                    'razorpay_payment_id'=>$request->all()['rzp_paymentid'],             
                    'dev_payment_status'=>'SUCCESS',
                    'date' => date("Y-m-d")             
                    );              
                    DB::table('developer_payment_transfer_tb')->insert($order_data);

                    $wallet_data=array(
                        'transaction_status'=>1,
                    );
                    DB::table('wallet_tb')->where('order_id',$order_id)->where('id',$wallet_id)->update($wallet_data);
                    
                    $emails=array();
                    $emails[]= $email;

                    $datas=array(
                        'name'=>$name,
                        'order_id'=>$order_id,
                        'amount'=>$amount,
                    );
                    
                    Mail::send('developer_transfer_confirm_mail', $datas, function($message) use ($emails) {
                        $message->to($emails)->subject('Mellow Elements');
                        $message->from('info@mellowelements.in', 'Mellow Elements');   
                    });

                    Mail::send('admin_transfer_confirm_mail', $datas, function($message) {
                       $message->to('mellowtulika@gmail.com')->subject('Mellow Elements');
                       $message->from('info@mellowelements.in', 'Mellow Elements');  
                    });
                    
                    return redirect()->route('transfer_thank_you');
                
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

    public function transfer_thank_you()
    {  
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        return view('admin/transfer_thank_you')->with($data);
    }

    public function commission()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['higher_professional_details'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $data['commission_details'] = DB::table('commission_tb')->orderby('id','desc')->get();
        return view('admin/commission')->with($data); 
    }

    public function submit_commission(Request $request)
    {   
        request()->validate(
        [
            'category_id' => 'required',
            'commission' => 'required',
        ]);

        $data=array(
           
            'category_id'=>$request->post('category_id'),
            'commission'=>$request->post('commission')
        );

        $result=DB::table('commission_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'success', 'commissionerrmsg' =>'Commission Added Successfully.']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'commissionerrmsg'=>'Commission Added Failed.']); 
            return redirect()->back();
        }
    }

    public function update_commission(Request $request)
    {
        request()->validate(
        [
            'category_id' => 'required',
            'commission' => 'required',
        ]);  

        $data=array(

            'category_id'=>$request->post('category_id'),
            'commission'=>$request->post('commission')
        );
        $id=$request->post('update');       
        $result=DB::table('commission_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'commissionerrmsg' =>'Commission Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'commissionerrmsg'=>'Commission Update Failed.']); 
            return redirect()->back();
        }
    }
    
    public function delete_commission($id)
    {
        $info_delete=DB::table('commission_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'success', 'commissionerrmsg'=>'Commission Delete Successfully. ']); 
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'commissionerrmsg'=>'Commission Delete Failed']); 
            return redirect()->back();
        }
    } 

    public function request_for_reward()
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['requested_reward_details'] = DB::table('milestone_tb')->where('rating_status','1')->where('withdraw_status',null)->get();
        $data['total_requested_reward_details'] = DB::table('milestone_tb')->where('rating_status','1')->where('withdraw_status',null)->count();
        $data['developer_details'] = DB::table('developer_details_tb')->get();
        $data['developer_rating'] = DB::table('developer_rating')->get();
        
        return view('admin/request_for_reward')->with($data);
    }

    public function withdraw_status_submit(Request $request)
    {
        // $id = $request->post('withdraw_status');
            
        for ($i=0; $i < count($request->post('milestone_id')); $i++) { 

            $data=array(
                'withdraw_status'=>'1',
            );   
                 $checkbox = $request->post('milestone_id');
            // $milestone_id =implode(',', $request->post('milestone_id'));
             $milestone_id = $checkbox[$i]; 
            $result=DB::table('milestone_tb')->where('id',$milestone_id)->update($data);
        }
            if($result==true)
            {
                session(['message' =>'success', 'widthdrawerrmsg' =>'Widthdraw Approve Successfully...']);
                return redirect()->back();
            }
            else
            {
                session(['message' =>'danger', 'widthdrawerrmsg'=>'Widthdraw Approval Failed.']); 
                return redirect()->back();
            }
    }

    public function web_hosting()
    {
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['web_hosting'] = DB::table('web_hosting_tb')->orderby('id','desc')->get();
        return view('admin/web_hosting')->with($data);
    }
   
    public function submit_web_hosting(Request $request)
    {  
       
        request()->validate(
        [
            'hostingname' => 'required',
            'hostingprice' => 'required',
            'feature' => 'required'
        ]);

        $data=array(
           
            'hostingname'=>$request->post('hostingname'),
            'hostingprice'=>$request->post('hostingprice'),
            'feature'=>$request->post('feature')
        );

        $result=DB::table('web_hosting_tb')->insert($data);
        if($result==true)
        {
            session(['message' =>'Web Hosting Added Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Web Hosting Added Failed.']);
            return redirect()->back();
        }
    }
   
    public function update_web_hosting(Request $request)
    {
       
        request()->validate(
        [
            'hostingname' => 'required',
            'hostingprice' => 'required',
            'feature' => 'required'
        ]);  

        $data=array(

            'hostingname'=>$request->post('hostingname'),
            'hostingprice'=>$request->post('hostingprice'),
            'feature'=>$request->post('feature')
        );
        $id=$request->post('update');      
        $result=DB::table('web_hosting_tb')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'Web Hosting Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Web Hosting Update Failed.']);
            return redirect()->back();
        }
    }
   
    public function delete_web_hosting($id)
    {
       
        $info_delete=DB::table('web_hosting_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
            session(['message' =>'Web Hosting Delete Successfully. ']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'Web Hosting Delete Failed']);
            return redirect()->back();
        }
    } 
    
    public function send_interview_link(Request $request)
    {   
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        $data['interview_schedule'] = DB::table('developer_interview_schedule')->orderby('id','desc')->get();
        
        $email=$request->post('email');
        $dev_id= Session::get('dev_id');
        
        $count = DB::table('developer_details_tb')->where('email',$email)->count();
        
        if($count == 0)
        {
            request()->validate(
            [
                'schinterviewdatetime' => 'required',
                'interviewlink' => 'required',
            ]);
  
            $data=array(
                'schinterviewdatetime'=>$request->post('schinterviewdatetime'),
                'interviewlink'=>$request->post('interviewlink'),
                'status'=>"Scheduled",
            );
            
            $id=$request->post('update');   
            
            $result=DB::table('developer_interview_schedule')->where('dev_id',$dev_id)->update($data);
            
            $result=DB::table('developer_order_tb')->where('dev_id',$dev_id)->update($data);

            //echo $result; exit();

            $email =  $request->post('email');
            $details = DB::table('developer_details_tb')->where('email',$email)->get();
            
            $emails=array();
            foreach ($details as $key) 
            {
                $emails[]= $key->email;
                $email = $key->email;
            }

            $datas=array(
                'email'=>$email,
            );

            if($result==true)
            {
                session(['message' =>'success', 'errmsg' =>'Interview Date Send Successfully...']);
                Mail::send('send_interview_link_mail', $datas, function($message) use ($emails)
                {
                    $message->to($emails)->subject('Mellow Elements');
                    
                    $message->from('info@mellowelements.in', 'Mellow Elements');   
                });
                return redirect()->route('interview_schedule_developer');
            }
            else
            {
                session(['message' =>'danger', 'errmsg'=>'Interview Date Added Failed.']); 
                return redirect()->back();
            }
        }else
            {
                session(['message' =>'danger', 'errmsg' =>'Email Address Already Exists.']);
                return redirect()->back();
            }
    }

    public function premium()
    { 
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        // $data['web_hosting'] = DB::table('web_hosting_tb')->orderby('id','asc')->get();

        $data['premium'] = Premium::orderBy('id', 'desc')->get();
        
        $data['prices'] = developerPremiumPrice::orderBy('id', 'desc')->get();

        return view('admin/premium')->with($data);
    }

    public function premiumId(Request $request)
    {   
        $premium = Premium::where('id', $request->id)->first();

        return response()->json(['success' => true, 'data' => $premium]);
    }

    public function premiumPointsStore(Request $request)
    {   
        Premium::create([
            'name' => $request->points,
        ]);

        return redirect()->back()->with('success', 'Premium point added successfully.');


    }

    public function premiumPointsUpdate(Request $request)
    {   
        Premium::where('id', $request->id)->update([
            'name' => $request->points,
        ]);

        return redirect()->back()->with('success', 'Premium point updated successfully.');


    }
    
    public function premiumPointsDelete(Request $request)
    {   
        Premium::where('id', $request->id)->delete();
        
        return response()->json(['success' => true, 'massege' => "Successfully deleted"]);
    }
    
    public function premiumPriceStore(Request $request)
    {  
        developerPremiumPrice::where('id', $request->name)->update([
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Premium Price updated successfully.');


    }
    
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        Mail::raw($request->message, function ($message) use ($request) {
            $message->to($request->email)
                    ->subject($request->subject);
        });
    
        session(['message' => 'success', 'errmsg' => 'Email sent successfully!.']);
        return redirect()->back();
    }
    
    public function subscriptionPlan()
    { 
        $email= Session::get('admin_login_role');
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        // $data['web_hosting'] = DB::table('web_hosting_tb')->orderby('id','asc')->get();

        $data['premium'] = Premium::orderBy('id', 'desc')->get();
        
        $data['prices'] = developerPremiumPrice::orderBy('id', 'desc')->get();

        return view('admin.subscription_plan')->with($data);
    }
    
    public function employeeSalaryDue()
    {
         $email= Session::get('admin_login_role');
         
        $payout = DB::table('developer_payment_monthly as d')
        ->join('user_login as u', 'u.id', '=','d.u_id')
        ->where('d.payment_status', 'unpaid')
        ->groupBy('d.u_id')
        ->get();

        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();

        return view('admin.employeeSalaryDue', compact('payout'))->with($data);
    }

    public function employeeSalaryDueId($id)
    {
        $payout = DB::table('developer_payment_monthly as d')
        ->join('user_login as u', 'u.id', '=','d.u_id')
        ->where('d.payment_status', 'unpaid')
        ->where('d.u_id', $id)
        ->get();

        return view('admin.employeeSalaryDueView', compact('payout'));
    }
    
    public function employeeAdvanceDue()
    {
        $email= Session::get('admin_login_role');

        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();

        $payout = DB::table('developer_order_tb as d')
                ->join('user_login as u', 'u.id', '=','d.u_id')
                ->where('d.status', 2)
                ->whereColumn('d.perhr', '!=', 'd.payment_amount')
                ->get();

        return view('admin.employeeAdvanceDue', compact('payout'))->with($data);
    }

    public function getEmployeePayout()
    {
        $payout = DB::table('developer_order_tb as d')
            ->join('user_login as u', 'u.id', '=', 'd.u_id')
            ->where('d.status', 2)
            ->whereColumn('d.perhr', '!=', 'd.payment_amount')
            ->get();

        return Excel::download(new EmployeePayoutExport($payout), 'employee_payout.xlsx');
    }

    public function activeDeveloperDetails()
    {
        $payout = DB::table('developer_details_tb')
        ->select('higher_professional_tb.id as ids','higher_professional_tb.heading','developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.description','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.total_hours','developer_details_tb.rating','developer_details_tb.address','developer_details_tb.language','developer_details_tb.education','developer_details_tb.skills','developer_details_tb.completed_job','developer_details_tb.portfolio_image','developer_details_tb.resume','developer_details_tb.developer_status','developer_details_tb.available_start_date','developer_details_tb.available_end_date','developer_details_tb.login_status','developer_details_tb.clg_name','developer_details_tb.degree','developer_details_tb.percentage','developer_details_tb.passing_year','developer_details_tb.bank_name','developer_details_tb.branch_name','developer_details_tb.acct_name','developer_details_tb.account_number','developer_details_tb.ifc_code','developer_details_tb.micr_number','developer_details_tb.passbook','developer_details_tb.account_Type')
        ->join('higher_professional_tb','higher_professional_tb.id' , '=' , 'developer_details_tb.pro_id')
        ->where('developer_details_tb.login_status',1)
        ->orderby('developer_details_tb.dev_id','desc')
        ->get();

        return Excel::download(new ActiveDeveloperDetailsExport($payout), 'active_developer_details.xlsx');
    }
    
    public function employeeDetails($id)
    {
          $payout = DB::table('developer_order_tb as d')
                ->join('user_login as u', 'u.id', '=','d.u_id')
                ->where('d.status', 2)
                ->where('u.id', $id)
                ->whereColumn('d.perhr', '!=', 'd.payment_amount')
                ->get();

        return view('admin.employeeAdvanceDueView', compact('payout'));
    }
    
    public function premiumDeveloperExcel()
    {
        $payout = DB::table('premium_order_tb')->orderby('id','desc')->get();

        return Excel::download(new premiumDeveloperExcel($payout), 'premium_developer.xlsx');
    }
    public function resoureDetailsExcel()
    {
        $payout =  DB::table('developer_order_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.address','developer_details_tb.phone as dev_phone','developer_details_tb.job','developer_details_tb.total_hours','developer_details_tb.perhr','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.education','developer_details_tb.description','developer_details_tb.skills','developer_details_tb.completed_job','developer_details_tb.image','developer_details_tb.portfolio_image','developer_details_tb.resume','developer_details_tb.date','developer_order_tb.fname','developer_order_tb.lname','developer_order_tb.dev_id','developer_order_tb.phone','developer_order_tb.address_one','developer_order_tb.email','developer_order_tb.u_id','developer_order_tb.country','developer_order_tb.state','developer_order_tb.city','developer_order_tb.payment_status')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->get();

        return Excel::download(new resoureDetailsExcel($payout), 'resoure_details.xlsx');
    }

    public function sendMail(Request $request)
    {
        $email= Session::get('admin_login_role');

        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();

        return view('admin.sendMail')->with($data);
    }

    public function sendMailSave(Request $request)
    {

        $recipients = $this->getRecipients($request->recipient_type, $request->email);
        
        if (empty($recipients)) {
            return response()->json([
                'success' => false,
                'message' => 'No valid recipients provided'
            ], 400);
        }

        $staff = (object)[
            'name' => $request->sender_name,
            'email' => $request->email ?? 'no-reply@example.com'
        ];

        try {
            // Process attachments for queuing
            $attachmentsForQueue = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    // Store the file content directly in the job (for small files)
                    $attachmentsForQueue[] = [
                        'content' => file_get_contents($file->getRealPath()),
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType()
                    ];
                }
            }

            $failedRecipients = [];
            $successCount = 0;
            
            foreach ($recipients as $recipient) {
                try {
                    // SendEmailJob::dispatch(
                    //     $recipient,
                    //     $staff,
                    //     $request->subject,
                    //     $request->message,
                    //     $attachmentsForQueue
                    // )->onQueue('emails');

                    Mail::to($recipient)->queue(
                        new StaffAccountCreated(
                            $staff,
                            $request->subject,
                            $request->message,
                            $attachmentsForQueue
                        )
                    );
                    
                    $successCount++;
                } catch (\Exception $e) {
                    $failedRecipients[$recipient] = $e->getMessage();
                    \Log::error("Failed to dispatch email job for {$recipient}: " . $e->getMessage());
                }
            }

            if (count($failedRecipients) > 0) {
                return response()->json([
                    'success' => $successCount > 0,
                    'message' => $successCount > 0 
                        ? 'Some emails were queued successfully' 
                        : 'Failed to queue all emails',
                    'failed_recipients' => $failedRecipients,
                    'sent_count' => $successCount
                ], $successCount > 0 ? 207 : 500);
            }

            // return response()->json([
            //     'success' => true,
            //     'message' => 'All emails were queued successfully for ' . count($recipients) . ' recipients'
            // ]);

            session(['message' => 'success', 'errmsg' => 'Email sent successfully!.']);
            return redirect()->back();

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process email request: ' . $e->getMessage()
            ], 500);
        }
    }

    protected function getRecipients($recipientType, $singleEmail = null)
    {
        $recipients = [];

        switch ($recipientType) {
            case 'developer':
                $recipients = DB::table('developer_details_tb')->pluck('email')->toArray();
                break;
            case 'employer':
                $recipients = DB::table('user_login')->pluck('email')->toArray();
                break;
            case 'all':
                $devs = DB::table('developer_details_tb')->pluck('email')->toArray();
                $emps = DB::table('user_login')->pluck('email')->toArray();
                $recipients = array_merge($devs, $emps);
                break;
            case 'single':
            default:
                if ($singleEmail) {
                    $recipients = [$singleEmail];
                }
                break;
        }

        return $recipients;
    }

    public function reportEmployerExcel()
    {
        
        $payout = \App\Models\Employer::with(['bankDetail', 'kyc','hiredDevelopers'])->get();

        return Excel::download(new EmployerDetialExcel($payout), 'employee_detail.xlsx');
    }
    
    public function reportDeveloperExcel()
    {
        $payout = \App\Models\Developer::with(['projects','developerOrders'])->get();
    
       return Excel::download(new DeveloperDetialExcel($payout), 'developer_detail.xlsx');
    }

    public function showCollege()
    {
        $email= Session::get('admin_login_role');

        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();

        $data['college'] = DB::table('college')->paginate('10');

        return view('admin.college.index')->with($data);
    }

    public function collegeCreate()
    {
        $email= Session::get('admin_login_role');

        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();

        return view('admin.college.create')->with($data);
    }

    public function collegeStore(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:college,email|max:255',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',
            'count' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        try {
            DB::table('college')->insert([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']), // Properly hashed password
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'count' => $validated['count'] ?? 0,
                'status' => $validated['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.college.index')
                ->with('success', 'College created successfully!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error creating college: ' . $e->getMessage());
        }
    }
    
    public function collegeEdit($id)
    {
        $email= Session::get('admin_login_role');
        
        $data['rolesdetails'] = DB::table('admin_tb')->where('role',$email)->get();
        
        $data['college'] = DB::table('college')->where('id',$id)->first();
        
        return view('admin.college.edit')->with($data);
    }

    public function collegeUpdate(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'id' => 'required|exists:college,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:college,email,'.$request->id.'|max:255', // Exclude current record
            'password' => 'nullable|string|min:8',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',
            'count' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        try {
            $updateData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'count' => $validated['count'] ?? 0,
                'status' => $validated['status'],
                'updated_at' => now(),
            ];

            // Only update password if provided
            if (!empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            DB::table('college')->where('id', $validated['id'])->update($updateData);

            return redirect()->route('admin.college.index')
                ->with('success', 'College updated successfully!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error updating college: ' . $e->getMessage());
        }
    }
}