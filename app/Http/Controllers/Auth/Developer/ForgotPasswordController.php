<?php

namespace App\Http\Controllers\Auth\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Developer;
use Illuminate\Support\Facades\URL;


class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('developer.forgetpassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $developer = Developer::where('email', $request->email)->first();

        if (!$developer) {
            return response()->json(['message' => 'We can\'t find a developer with that email address.'], 404);
        }

        // Generate token
        $token = Str::random(60);

        // Save token
        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'token' => bcrypt($token),
                'created_at' => Carbon::now()
            ]
        );

        // Build reset link
        $resetUrl = route('password.reset.form', ['token' => $token]) . '?email=' . urlencode($request->email);

        // Professional email content
        $emailBody = <<<EOT
        Dear {$developer->name},

        We received a request to reset your password for your developer account at Mellow Academy.

        To proceed, please click the link below to set a new password:
        $resetUrl

        If you did not request a password reset, please ignore this email. Your current password will remain unchanged.

        Best regards,  
        Mellow Academy Support Team
        EOT;

        // Send email
        Mail::raw($emailBody, function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset Request – Mellow Academy');
        });

        return response()->json(['message' => 'A password reset link has been sent to your email address.']);
    }

}