<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $approved;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($approved)
    {
        $this->approved=$approved;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Admin Approved')
            ->view('admin//email/approved-mail');
    
    }
}
