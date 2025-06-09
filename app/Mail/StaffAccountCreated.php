<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $subject;
    public $message;
    public $attachments;

    public function __construct($staff, $subject, $message, $attachments = [])
    {
        $this->staff = (object)$staff; // Ensure staff is always an object
        $this->subject = $subject;
        $this->message = $message;
        $this->attachments = is_array($attachments) ? $attachments : [];
    }

    public function build()
    {
        $email = $this->subject($this->subject)
                    ->markdown('emails.staff_created')
                    ->with([
                        'name' => $this->staff->name,
                        'email' => $this->staff->email,
                        'content' => $this->message,
                    ]);

        // Process attachments if any
        foreach ($this->attachments as $attachment) {
            if (isset($attachment['file_path']) && file_exists($attachment['file_path'])) {
                $email->attach(
                    $attachment['file_path'],
                    [
                        'as' => $attachment['original_name'] ?? 'attachment',
                        'mime' => $attachment['mime_type'] ?? mime_content_type($attachment['file_path'])
                    ]
                );
            }
        }

        return $email;
    }
}