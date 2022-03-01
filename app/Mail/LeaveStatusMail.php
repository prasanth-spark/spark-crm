<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public  $user,$status;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $status =$this->status;
        $user = $this->user;
        
        return $this->$this->subject('Leave Status')
        ->view('employee/email/leave_status',compact('user','status'));
    }
}
