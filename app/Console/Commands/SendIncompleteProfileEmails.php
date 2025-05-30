<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Developer;

class SendIncompleteProfileEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-incomplete-profiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to users with incomplete profiles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = Developer::where('profile_complete', '<', 100)->get();
        foreach ($users as $user) {
            $subject = "Please Complete Your Profile – KYC, Bank Details & More";
            $message = "Dear {$user->name},\n\n"
                     . "We noticed that your profile is incomplete. To proceed smoothly with our onboarding and compliance process, please update the following details:\n"
                     . "- Personal Profile Information\n"
                     . "- KYC (Know Your Customer)\n"
                     . "- Bank Details\n\n"
                     . "Visit your dashboard to complete the profile.\n\n"
                     . "Thanks & Regards,\n"
                     . "Mellow Voult";

            Mail::raw($message, function ($mail) use ($user, $subject) {
                $mail->to($user->email)->subject($subject);
            });
        }

        $this->info('Email notifications sent to users with incomplete profiles.');
    }
}