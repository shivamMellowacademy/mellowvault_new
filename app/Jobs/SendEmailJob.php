<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\StaffAccountCreated;
use Illuminate\Support\Facades\Storage;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipient;
    protected $staff;
    protected $subject;
    protected $message;
    protected $attachments;

    public function __construct($recipient, $staff, $subject, $message, $attachments)
    {
        $this->recipient = $recipient;
        $this->staff = $staff;
        $this->subject = $subject;
        $this->message = $message;
        $this->attachments = $attachments;
    }

    public function handle()
    {
        // Process attachments - store them temporarily if they're not already stored
        $processedAttachments = [];
        
        foreach ($this->attachments as $attachment) {
            if (is_array($attachment) && isset($attachment['content'])) {
                // If content was stored directly (alternative approach)
                $tempPath = tempnam(sys_get_temp_dir(), 'mail_');
                file_put_contents($tempPath, $attachment['content']);
                $processedAttachments[] = [
                    'file_path' => $tempPath,
                    'original_name' => $attachment['original_name'],
                    'mime_type' => $attachment['mime_type']
                ];
            } else {
                // Regular file path handling
                $processedAttachments[] = $attachment;
            }
        }

        try {
            Mail::to($this->recipient)
                ->send(new StaffAccountCreated(
                    $this->staff,
                    $this->subject,
                    $this->message,
                    $processedAttachments
                ));
        } finally {
            // Clean up temporary files
            foreach ($processedAttachments as $attachment) {
                if (isset($attachment['file_path']) && file_exists($attachment['file_path'])) {
                    @unlink($attachment['file_path']);
                }
            }
        }
    }
}