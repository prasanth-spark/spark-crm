<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveRejectedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $leave_status,$user,$reason;
    /**
     * Create a new message instance.
     *
     * 
     * @return void
     */
    public function __construct($leave_status,$user,$reason)
    {
        $this->status = $leave_status;
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
        // dd($user);
        return $this->subject('Leave Rejected')
        ->view('employee/email/leave_rejected',compact('user','reason'));
    }
}
