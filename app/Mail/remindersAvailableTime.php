<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class remindersAvailableTime extends Mailable
{
    use Queueable, SerializesModels;
    
    public $fname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fname)
    {
         $this->fname = $fname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reminder: Provide Your Available Time - Mellow Elements')
                    ->view('emails.developer_reminder');
    }
}
