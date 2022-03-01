<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $status,$user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status,$user)
    {
        $this->status = $status;
        $this->user = $user;
        
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
        return $this->subject('Leave Status')
        ->view('employee/email/leave_status',compact('user','status'));
    }
}
