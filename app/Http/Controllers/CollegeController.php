<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            // Find college by email
            $college = DB::table('college')
                    ->where('email', $validated['email'])
                    ->where('status', 1) // Only allow active colleges
                    ->first();

            // Check if college exists and password matches
            if ($college && Hash::check($validated['password'], $college->password)) {
                // Manually create session for college
                session([
                    'college_id' => $college->id,
                    'college_name' => $college->name,
                    'college_email' => $college->email,
                    'last_login_at' => now()
                ]);
                

                // Record login time
                DB::table('college')
                ->where('id', $college->id)
                ->update(['last_login_at' => now()]);

                return redirect()->intended(route('college.dashboard'))
                            ->with('success', 'Login successful! Welcome back!');
            }

            // Return generic error message (better security practice)
            return back()->withInput()
                    ->withErrors([
                        'login_error' => 'Invalid credentials or account not active',
                    ])
                    ->with('message', 'danger');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('College login error: ' . $e->getMessage());
            
            return back()->withInput()
                    ->withErrors([
                        'login_error' => 'An error occurred during login. Please try again.',
                    ])
                    ->with('message', 'danger');
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
        $data['college_list'] = DB::table('higher_professional_tb')->orderBy('id','DESC')->pluck('heading');

        return view('college.developers.ceate')->with($data);
    }

    public function developersStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'specialization' => 'required|exists:higher_professional_tb,heading',
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:15|unique:developer_details_tb,phone',
            'email' => 'required|email|max:100|unique:developer_details_tb,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            
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

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating developer: ' . $e->getMessage());
            
            // Redirect back with error message
            return back()->withInput()
                        ->with('error', 'An error occurred while creating the developer. Please try again.');
        }
    }
}
