<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveAcceptanceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $leave_status,$user,$leaveType;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($leave_status,$user,$leaveType)
    {
        $this->leave_status = $leave_status;
        $this->user = $user;
        $this->leaveType=$leaveType;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            $user = $this->user;
            $leaveType=$this->leaveType;
            return $this->subject('Leave Accepted')
            ->view('employee/email/leave_accepted',compact('user','leaveType'));
    } 
}
