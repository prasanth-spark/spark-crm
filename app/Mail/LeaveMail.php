<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveMail extends Mailable
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
        $teamLeadName=$this->teamLeadName;
        $user=$this->user;
        $teamLead = $this->user->where('name',$teamLeadName)->first();
        $reason=$this->reason;
        $leaveDetail=$this->leaveDetail;
        $leaveType=$leaveDetail->leave_type_id;
        $start_date = date('d-m-Y', strtotime($leaveDetail->start_date));
        $end_date = date('d-m-Y', strtotime($leaveDetail->end_date));

        return $this->subject('Requesting Leave')
            ->view('employee/email/leave_form',compact('teamLeadName','teamLead','user','reason','leaveType','start_date','end_date'));
    }
}
