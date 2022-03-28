<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PermissionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $teamLeadName,$user,$reason,$leaveDetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teamLeadName,$user,$reason,$leaveDetail)
    {
        $this->teamLeadName = $teamLeadName;
        $this->user=$user;
        $this->reason=$reason;
        $this->leaveDetail=$leaveDetail;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $teamLeadName = $this->teamLeadName;
        $user=$this->user;
        $teamLead = $this->user->where('name',$teamLeadName)->first();
        $reason=$this->reason;
        $leaveDetail=$this->leaveDetail;
        return $this->subject('Requesting Permission')
            ->view('employee/email/permission_form',compact('teamLeadName','teamLead','user','reason','leaveDetail'));
    }
}
