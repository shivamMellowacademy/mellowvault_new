<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\User;
use App\Models\DeveloperOrder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use DB;

class EmployerController extends Controller
{
    
    public function employerRegister(Request $request)
    {
        $latestEmployer = Employer::latest('id')->first();
        return response()->json([
            'status' => true,
            'message' => 'Latest employer retrieved successfully.',
            'data' => $latestEmployer
        ], 200);

    }
    
    public function employerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employer = Employer::where('email', $request->email)->first();

        if (!$employer) {
            return response()->json([
                'status' => false,
                'message' => 'Employer not found.'
            ], 404);
        }

        $inputPassword = $request->password;

        // First check with Hash::check (for bcrypt)
        if (Hash::check($inputPassword, $employer->password)) {
            // Matched using Hash::check
        }
        // Then fallback to legacy md5 check
        elseif ($employer->password === md5($inputPassword)) {
            // Optionally: Upgrade password to Hash::make() for future logins
            $employer->password = Hash::make($inputPassword);
            $employer->save();
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect password.'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'data' => [
                'id' => $employer->id,
                'email' => $employer->email,
                'name' => $employer->fname,
            ]
        ], 200);
    }

    public function employerProfile(Request $request)
    {  
        $employerId = $request->employerId;
        $data = User::find($employerId);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Profile fetched successfully.',
                'EmployerProfile' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Un-Authenticate Or Employer not found.'
            ], 404);
        }
    }
    
    public function employerResource(Request $request)
    {
        $employerId = $request->employerId;

        if (!$employerId) {
            return response()->json([
                'status' => false,
                'message' => 'Employer ID is required.',
            ], 400);
        }

        $employerResourceDetails = DeveloperOrder::with('developer')
            ->where('u_id', $employerId)
            ->orderBy('dev_id', 'desc')
            ->get();

        if ($employerResourceDetails->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Un-Authenticate Or No developer resources found for this employer ID.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Developer resources retrieved successfully.',
            'data' => $employerResourceDetails
        ]);
    }

    public function employerOngoingResource(Request $request)
    {
        $employerLoginId = $request->employerId;

        if (!$employerLoginId) {
            return response()->json([
                'status' => false,
                'message' => 'employer login ID is required.',
            ], 400);
        }

        // Use Eloquent to fetch the ongoing resource details
        $ongoingResourceDetails = DeveloperOrder::with('developer')  // eager load the related developer
            ->where('u_id', $employerLoginId)
            ->whereHas('developer', function($query) {
                $query->where('developer_status', 'Booked');  // filter based on status 'Booked'
            })
            ->orderBy('dev_id', 'desc')
            ->get();

        if ($ongoingResourceDetails->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No ongoing developer resources found for this employer login ID.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Ongoing developer resources retrieved successfully.',
            'data' => $ongoingResourceDetails
        ]);
    }
    
    public function employerCompletedResource(Request $request)
    {
        $employerLoginId = $request->employerId;

        if (!$employerLoginId) {
            return response()->json([
                'status' => false,
                'message' => 'Employer login ID is required.',
            ], 400);
        }

        $completedResourceDetails = DeveloperOrder::with('developer')
            ->where('u_id', $employerLoginId)
            ->where('payment_status', 'SUCCESS')
            ->orderBy('dev_id', 'desc')
            ->get();

        if ($completedResourceDetails->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No completed resources found for this employer login ID.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Completed developer resources retrieved successfully.',
            'data' => $completedResourceDetails
        ]);
    }

    public function employerUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        $userId = $request->employerId;
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $oldPassword = $request->old_password;
        $newPassword = $request->new_password;

        $isOldPasswordMatched = false;

        // Check both Hash and md5
        if (Hash::check($oldPassword, $user->password)) {
            $isOldPasswordMatched = true;
        } elseif ($user->password === md5($oldPassword)) {
            $isOldPasswordMatched = true;
        }

        if (!$isOldPasswordMatched) {
            return response()->json([
                'status' => false,
                'message' => 'Old password does not match.'
            ], 400);
        }

        // Update with Hash only
        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully.'
        ]);
    }

  

    public function employerProfileUpdate(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:user_login,id',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|digits:10',
                'user_name' => 'required|min:5|max:255',
                'company_name' => 'nullable|string|max:255',
                'user_purpose' => 'nullable|string|max:255',
            ]);

            $user = User::find($request->id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.',
                ], 404);
            }

            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->user_name = $request->user_name;
            $user->company_name = $request->company_name;
            $user->purpose = $request->user_purpose;
            $user->date = now();

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully.',
                'data' => $user
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Edit profile error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function developerOrderData($employerId)
    { 
        return  $developer_order_details = DB::table('developer_order_tb')->where('payment_status' ,'=', 'SUCCESS')->where('u_id' ,'=', $employerId )->count();
    }

    public function resource(Request $request)
    {
        $employerId = $request->input('employerId');
        $developerId = $request->input('developerId');

        if (!$employerId || !$developerId) {
            return response()->json(['error' => 'Missing u_id or dev_id'], 422);
        }

        $show = [];

        $show['premium_profile_details'] = DB::table('developer_order_tb')
            ->select(
                'qualified_order_tb.p_code',
                'qualified_order_tb.dev_id',
                'qualified_order_tb.payment_status',
                'developer_order_tb.u_id',
                'developer_order_tb.dev_id',
                'developer_order_tb.status',
                'developer_order_tb.payment_status'
            )
            ->join('qualified_order_tb', 'qualified_order_tb.dev_id', '=', 'developer_order_tb.dev_id')
            ->where('qualified_order_tb.payment_status', 'SUCCESS')
            ->get();

        $show['developer_order_resource'] = DB::table('developer_order_tb')->where('u_id', $employerId)->get();

        $show['developer_payment_resource'] = DB::table('qualified_order_tb')->where('dev_id', $developerId)->where('payment_status', 'SUCCESS')->get();

        $show['developerid'] = DB::table('qualified_order_tb')->where('dev_id', $developerId)->count();

        $show['developer_interview_resource'] = DB::table('developer_interview_schedule')->where('dev_id', $developerId)->get();

        $show['developer_order_details'] = $this->developerOrderData($employerId);

        $show['allproduct'] = DB::table('product_tb')->orderBy('id', 'desc')->limit(3)->get();
        $show['user_details'] = DB::table('user_login')->orderBy('id', 'desc')->get();
        $show['about'] = DB::table('about_tb')->orderBy('id', 'desc')->get();
        $show['category'] = DB::table('category_tb')->orderBy('id', 'desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderBy('id', 'asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderBy('id', 'desc')->get();
        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
            ->select(
                'product_tb.name',
                'product_tb.image',
                'product_tb.tax',
                'product_tb.video',
                'product_tb.price',
                'product_tb.pro_size',
                'product_tb.id',
                'cart_tb.u_id',
                'cart_tb.id',
                'cart_tb.status'
            )
            ->join('product_tb', 'product_tb.id', '=', 'cart_tb.p_id')
            ->whereNull('status')
            ->get();

        $show['cart_value'] = DB::table('cart_tb')->where('status', NULL)->where('u_id', $employerId)->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status', NULL)->where('u_id', $employerId)->count();

        $show['dev_order_details_empty'] = DB::table('developer_order_tb')
            ->join('developer_details_tb', 'developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
            ->where('u_id', $employerId)
            ->where('developer_order_tb.payment_status', 'SUCCESS')
            ->where('developer_order_tb.status', '1')
            ->count();

        // Continue fetching developer resources as in your original code...

        $show['developer_resources'] = DB::table('developer_order_tb')
            ->join('developer_details_tb', 'developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
            ->where('developer_order_tb.u_id', $employerId)
            ->where('developer_order_tb.payment_status', 'SUCCESS')
            ->select(
                'developer_details_tb.*',
                'developer_order_tb.interviewlink',
                'developer_order_tb.date',
                'developer_order_tb.interviewdateone',
                'developer_order_tb.interviewdatetwo',
                'developer_order_tb.status',
                'developer_order_tb.qdate'
            )
            ->get();

        // You can continue copying the remaining $show[...] values similarly...

        return response()->json($show);
    }

}
