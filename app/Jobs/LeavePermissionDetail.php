<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\LeaveAcceptanceMail;
use Illuminate\Support\Facades\Mail;

class LeavePermissionDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  public $teamLeadMail,$user,$reason;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($teamLeadMail,$user,$reason)
    {
       $this->teamLeadMail=$teamLeadMail;
       $this->user=$user;
       $this->reason=$reason;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user=$this->user;
        $reason=$this->reason;
        $teamLeadMail =$this->teamLeadMail; 
        $email = new LeaveAcceptanceMail($user,$reason);
        Mail::to($teamLeadMail)->send($email);
    }
}
