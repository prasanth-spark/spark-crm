<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\LeaveMail;
use Illuminate\Support\Facades\Mail;

class LeaveDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  public $teamLeadMail,$teamLeadName,$user,$reason,$leaveDetail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($teamLeadMail,$teamLeadName,$user,$reason,$leaveDetail)
    {
       $this->teamLeadMail=$teamLeadMail;
       $this->teamLeadName = $teamLeadName;
       $this->user=$user;
       $this->reason=$reason;
       $this->leaveDetail=$leaveDetail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $teamLeadName=$this->teamLeadName;
        $user=$this->user;
        $reason=$this->reason;
        $leaveDetail=$this->leaveDetail;
        $teamLeadMail=$this->teamLeadMail;
        $email = new LeaveMail($teamLeadName,$user,$reason,$leaveDetail);
        Mail::to($teamLeadMail)->send($email);
    }
}
