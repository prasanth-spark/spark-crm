<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AbsentStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $teamLeadName,$user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user =$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $user=$this->user;
        return $this->subject('Attendance Status')
        ->view('employee/email/absent_status',compact('user'));
    }
}
