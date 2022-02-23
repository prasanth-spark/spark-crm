<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveAcceptanceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $reason,$user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$reason)
    {
        $this->user=$user;
        $this->reason=$reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Requesting Leave')
            ->view('employee/email/leave_acceptance');
    }
}
