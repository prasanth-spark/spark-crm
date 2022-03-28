<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PermissionRejectedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user,$reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$reason)
    {
        $this->user = $user;
        $this->reason=$reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reason =$this->reason;
        $user = $this->user;
        return $this->subject('Permission Rejected')
        ->view('employee/email/leave_rejected',compact('user','reason'));
    }
}
