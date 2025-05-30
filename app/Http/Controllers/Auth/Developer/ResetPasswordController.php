<?php

namespace App\Http\Controllers\Auth\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Developer;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('developer.resetpasswordform', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    ]);

    // Find the reset record for the email
    $resetRecord = DB::table('password_resets')->where('email', $request->email)->first();

    // if (!$resetRecord) {
    //     return redirect()->back()->with('error', 'Invalid or expired reset link.1');
    // }


    // Check token expiration (valid for 60 minutes)
    if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
        return redirect()->back()->with('error', 'Reset link has expired.3');
    }

    // Find the developer account
    $developer = Developer::where('email', $request->email)->first();
    if (!$developer) {
        return redirect()->back()->with('error', 'Developer account not found.');
    }
    $password = Hash::make($request->password);
    // $data = [
    //     'password' =>  $password,
    // ];
    // $affectedRows = DB::table('developer_details_tb')->where('email', $request->email)->update($data);
    $developer->update([
        'password' => $password,
    ]);

    // Delete the used reset token
    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->back()->with('success', 'Password has been reset successfully. You can now log in.');
}

}
