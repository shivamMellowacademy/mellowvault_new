<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Developer;
use Illuminate\Support\Facades\Validator;

class DeveloperProfileController extends Controller
{
    
    public function developerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $developer = DB::table('developer_details_tb')->where('email', $request->email)->first();

        if ($developer && Hash::check($request->password, $developer->password)) {
            // Store developer session
            Session::put('developer_login_id', $developer->dev_id);
            Session::put('developer_email_login', $developer->email);
            Session::put('developer_name_login', $developer->name);

            return response()->json([
                'status' => true,
                'message' => 'Login Successfully.',
                'developer_id' => $developer->dev_id,
                'developer_name' => $developer->name,
                'developer_email' => $developer->email,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Login Failed. Username or password is incorrect.',
        ], 401);
    }

    public function developerData($developerId)
    {
        $developer_details = DB::table('developer_details_tb')
            ->where('dev_id', $developerId)
            ->get();

        $developer_project_details = DB::table('developer_project_details_tb')
            ->where('developer_id', $developerId)
            ->get();

        return [
            'developer_details' => $developer_details,
            'developer_project_details' => $developer_project_details,
        ];
    }

     /**
     * Developer Profile
     */
    public function developerProfile(Request $request)
    {
        $developer_id = $request->developer_id;

        if (!$developer_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please login first.',
            ], 401);
        }

        $developer_details = Developer::find($developer_id);

        if (!$developer_details) {
            return response()->json([
                'status' => false,
                'message' => 'Developer not found.',
            ], 404);
        }

        // Add full paths to files
        $developer_details->portfolio_image = $developer_details->portfolio_image
            ? url('upload/portfolio/' . $developer_details->portfolio_image)
            : null;

        $developer_details->resume = $developer_details->resume
            ? url('upload/resume/' . $developer_details->resume)
            : null;

        $developer_details->image = $developer_details->image
            ? url('upload/developer/' . $developer_details->image)
            : null;

        $developer_details->passbook = $developer_details->passbook
            ? url('public/upload/passbook/' . $developer_details->passbook)
            : null;

        $developer_project_details = DB::table('developer_project_details_tb')
            ->where('developer_id', $developer_id)
            ->get()
            ->map(function ($project) {
                $project->screenshot_image = $project->screenshot_image
                    ? url('upload/project/' . $project->screenshot_image)
                    : null;
                return $project;
            });

        $premium_profile_details = DB::table('premium_order_tb')
            ->where('dev_id', $developer_id)
            ->count();

        $joined_details = DB::table('developer_details_tb')
            ->select(
                'higher_professional_tb.id as ids',
                'higher_professional_tb.heading',
                'developer_details_tb.dev_id',
                'developer_details_tb.pro_id',
                'developer_details_tb.name',
                'developer_details_tb.last_name',
                'developer_details_tb.description',
                DB::raw("CONCAT('" . url('public/upload/developer') . "/', developer_details_tb.image) as image"),
                'developer_details_tb.phone',
                'developer_details_tb.email',
                'developer_details_tb.job',
                'developer_details_tb.perhr',
                'developer_details_tb.total_hours',
                'developer_details_tb.rating',
                'developer_details_tb.address',
                'developer_details_tb.language',
                'developer_details_tb.education',
                'developer_details_tb.skills',
                'developer_details_tb.completed_job',
                DB::raw("CONCAT('" . url('public/upload/portfolio') . "/', developer_details_tb.portfolio_image) as portfolio_image"),
                DB::raw("CONCAT('" . url('public/upload/resume') . "/', developer_details_tb.resume) as resume"),
                'developer_details_tb.developer_status',
                'developer_details_tb.show_password',
                'developer_details_tb.available_start_date',
                'developer_details_tb.available_end_date'
            )
            ->join('higher_professional_tb', 'higher_professional_tb.id', '=', 'developer_details_tb.pro_id')
            ->where('developer_details_tb.dev_id', $developer_id)
            ->get();

        return response()->json([
            'status' => true,
            'developer_details' => $developer_details,
            'developer_project_details' => $developer_project_details,
            'premium_profile_count' => $premium_profile_details,
            'joined_details' => $joined_details,
        ]);
    }


    public function developerKyc(Request $request)
    {   $developerId = $request->developerId;
        $kyc = $this->developerData($developerId);
        return response()->json([
            'status' => true,
            'kyc' => $kyc,
        ]);
    }
    
    public function developerWalletDetails(Request $request)
    {   $developerId = $request->developerId;
        $developerWalletMilestone = DB::table('milestone_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.perhr','developer_details_tb.pro_id','milestone_tb.milestone_name','milestone_tb.days','milestone_tb.dev_id','milestone_tb.dev_id','milestone_tb.id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'milestone_tb.dev_id')
        ->where('developer_details_tb.dev_id',$developerId)
        ->get();

        $commissionDetails = DB::table('commission_tb')->get();
        return response()->json([
            'status' => true,
            'developerWalletMilestone' => $developerWalletMilestone,
            'commissionDetails' => $commissionDetails,
        ]);
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'developerId' => 'required|exists:developer_details_tb,dev_id',
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }

        $developer = Developer::find($request->developerId);

        if (!$developer) {
            return response()->json([
                'status' => false,
                'message' => 'Developer not found.'
            ], 404);
        }

        if (!Hash::check($request->old_password, $developer->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password does not match.'
            ], 401);
        }

        $developer->password = Hash::make($request->new_password);
        $developer->save();

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.'
        ], 200);
    }

    public function developerProfileUpdate(Request $request)
    {
        $developer_id = $request->developer_id;

        $developer = Developer::find($developer_id);

        if (!$developer) {
            return response()->json([
                'status' => false,
                'message' => 'Developer not found.'
            ], 404);
        }

        $profile_complete = $developer->profile_complete;

        if ((empty($developer->job) || empty($developer->total_hours)) && $profile_complete < 90) {
            $profile_complete += 10;
            if ($profile_complete > 100) {
                $profile_complete = 100;
            }
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'job' => 'required',
            'total_hours' => 'required|numeric',
            'perhr' => 'required|numeric',
            'rating' => 'required|numeric',
            'address' => 'required',
            'language' => 'required',
            'skills' => 'required',
            'completed_job' => 'required|numeric',
            'portfolio_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
            'resume' => 'nullable|mimes:pdf|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // File: Portfolio Image
        if ($request->hasFile('portfolio_image')) {
            $imageName = time() . '.' . $request->portfolio_image->getClientOriginalExtension();
            $request->portfolio_image->move(public_path('upload/portfolio/'), $imageName);
        } else {
            $imageName = $request->old_portfolio_image;
        }

        // File: Resume
        if ($request->hasFile('resume')) {
            $resumeName = time() . '.' . $request->resume->getClientOriginalExtension();
            $request->resume->move(public_path('upload/resume/'), $resumeName);
        } else {
            $resumeName = $request->old_resume;
        }

        // Update developer data
        $developer->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description,
            'job' => $request->job,
            'total_hours' => $request->total_hours,
            'perhr' => $request->perhr,
            'rating' => $request->rating,
            'address' => $request->address,
            'language' => $request->language,
            'skills' => $request->skills,
            'completed_job' => $request->completed_job,
            'portfolio_image' => $imageName,
            'resume' => $resumeName,
            'profile_complete' => $profile_complete,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Developer profile updated successfully!'
        ]);
    }
    

    public function addBankDetailsApi(Request $request)
    {
        $developer_id = $request->developer_id;
        // Validate input
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'acct_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:30',
            'ifc_code' => 'required|string|max:30',
            'micr_number' => 'required|string|max:30',
            'account_Type' => 'required|string|max:50',
            'passbook' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $developer = Developer::find($developer_id);

        if (!$developer) {
            return response()->json([
                'status' => false,
                'message' => 'Developer not found.'
            ], 404);
        }

        // Calculate profile_complete if not already max
        $profile_complete = $developer->profile_complete ?? 0;
        if ($profile_complete < 100) {
            $profile_complete = min($profile_complete + 10, 100);
        }

        // Handle passbook upload
        $passbook_file = $developer->passbook;
        if ($request->hasFile('passbook')) {
            $passbook_file = time() . '.' . $request->file('passbook')->getClientOriginalExtension();
            $request->file('passbook')->move(public_path('upload/passbook'), $passbook_file);
        }

        // Update or create developer record
        $developer->update([
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'acct_name' => $request->acct_name,
            'account_number' => $request->account_number,
            'ifc_code' => $request->ifc_code,
            'micr_number' => $request->micr_number,
            'account_Type' => $request->account_Type,
            'profile_complete' => $profile_complete,
            'passbook' => $passbook_file,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Bank details updated successfully.',
            'data' => [
                'developer_id' => $developer->dev_id,
                'passbook' => $passbook_file ? url('public/upload/passbook/' . $passbook_file) : null,
                'profile_complete' => $profile_complete
            ]
        ]);
    }
    
    public function developersList(){
        $developerList = Developer::where('profile_complete', 100)->where('developer_status', 'Active')->where('login_status', 1)->orderBy('dev_id', 'DESC')->get();
        return response()->json([
            'status' => true,
            'message' => 'Developers successfully fetched',
            'data' => $developerList
        ]);
     }

    
}