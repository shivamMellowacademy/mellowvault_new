<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CollegeController extends Controller
{
    public function index()
    {
        return view('college.auth.login');
    }
    

    public function store(Request $request)
    {
        // Validate the login request
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        try {
            // Find college by email with proper column selection
            $college = DB::table('college') // Changed from 'college' to 'college' (assuming standard plural naming)
                ->where('email', $validated['email'])
                ->select('id', 'name', 'email', 'password', 'status', 'last_login_at')
                ->first();

            // Check if college exists
            if (!$college) {
                return back()->withInput()
                    ->withErrors([
                        'login_error' => 'Invalid credentials',
                    ]);
            }

            // Check if account is active
            if ($college->status != 1) {
                return redirect()->route('college.login') // Fixed typo in route name
                    ->with('message', 'Your account is not active. Please contact support.');
            }

            // Verify password
            if (!Hash::check($validated['password'], $college->password)) {
                return back()->withInput()
                    ->withErrors([
                        'login_error' => 'Invalid credentials',
                    ]);
            }

            // Create session
            session([
                'college_id' => $college->id,
                'college_name' => $college->name,
                'college_email' => $college->email,
                'last_login_at' => now()
            ]);

            // Update last login time
            DB::table('college')
                ->where('id', $college->id)
                ->update(['last_login_at' => now()]);

            return redirect()->intended(route('college.dashboard'))
                ->with('success', 'Login successful! Welcome back!');

        } catch (\Exception $e) {
            \Log::error('College login error: ' . $e->getMessage(), [
                'email' => $request->email,
                'ip' => $request->ip()
            ]);
            
            return back()->withInput()
                ->withErrors([
                    'login_error' => 'An error occurred during login. Please try again.',
                ]);
        }
    }

    public function dashboard()
    {
        $id = session('college_id');
        $data['count'] = DB::table('developer_details_tb')->where('college_id', $id)->count();
        $data['college_list'] = DB::table('developer_details_tb')->where('college_id', $id)->orderBy('dev_id','DESC')->take(5)->get();
        $data['college'] = DB::table('college')->where('id', $id)->first();

        return view('college.dashboard')->with($data);
    }

    public function developersIndex()
    {
        $id = session('college_id');
        $data['college_list'] = DB::table('developer_details_tb')->where('college_id', $id)->orderBy('dev_id','DESC')->paginate(10);

        return view('college.developers.index')->with($data);
    }

    public function developersCreate()
    {
        $data['college_list'] = DB::table('higher_professional_tb')->orderBy('id','DESC')->get();

        return view('college.developers.ceate')->with($data);
    }

    public function developersStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'specialization' => 'required|exists:higher_professional_tb,id',
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:15|unique:developer_details_tb,phone',
            'email' => 'required|email|max:100|unique:developer_details_tb,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {

            $college = DB::table('college')->where('id', session('college_id'))->first();

            $count =  DB::table('developer_details_tb')->where('college_id', session('college_id'))->count();



            if($college->count > $count)
            {
                // Create developer record
                $developer = DB::table('developer_details_tb')->insertGetId([
                    'pro_id' => $request->specialization,
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'show_password' => $request->password, 
                    'profile_complete' => 30, 
                    'college_id'  => session('college_id'), 
                ]);

                // Redirect with success message
                return redirect()->route('college.developers.index')->with('success', 'Developer created successfully!');
            }
            else
            {
                return back()
                    ->withInput()
                    ->with('error', 'Developer limit reached for this college');
            }

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating developer: ' . $e->getMessage());
            
            // Redirect back with error message
            return back()->withInput()
                        ->with('error', 'An error occurred while creating the developer. Please try again.');
        }
    }

    public function developersShow($id)
    {
       
        $developer = DB::table('developer_details_tb')->where('dev_id', $id)->first();

        $companyDetails = DB::table('developer_order_tb')->where('dev_id', $developer->dev_id)->first();

        $devProjectDetails = DB::table('developer_project_details_tb')->where('developer_id', $developer->dev_id)->get();

        return view('college.developers.show', compact('developer', 'companyDetails', 'devProjectDetails'));
      
    }

    public function collegeLogout()
    {
        session()->flush();

        return redirect()->route('college.login')->with('success', 'You have been successfully logged out.');
      
    }

    public function collegeChangePassword()
    {
        return view('college.changePassword');
      
    }

    public function collegePasswordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $college = DB::table('college')->where('id', session('college_id'))->first();
            // Verify current password
        if (!Hash::check($request->current_password, $college->password)) {
            return redirect()->back()
                ->with('error', 'Current password is incorrect')
                ->withInput();
        }

         try {
        // Update password
            $college->password = Hash::make($request->password);
            $college->save();

            return redirect()->back()
                ->with('success', 'Password changed successfully!');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Password change error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again later.')
                ->withInput();
        }
    }
}
