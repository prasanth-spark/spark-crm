<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\LeaveAcceptanceMail;
use App\Mail\LeaveRejectedMail;
use Illuminate\Support\Facades\Mail;

class LeaveMailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $leave_status,$user,$reason,$leaveType;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($leave_status,$user,$reason,$leaveType)
    {
        $this->leave_status = $leave_status; 
        $this->user = $user;
        $this->reason=$reason; 
        $this->leaveType=$leaveType;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $leave_status= $this->leave_status;
        $user= $this->user;
        $reason = $this->reason;
        $userMail = $user->email;
        $leaveType=$this->leaveType;
        // dd($leaveType);
        if($leave_status == 2){
            // dd($leaveType);
            $email = new LeaveAcceptanceMail($leave_status,$user,$leaveType);
            Mail::to($userMail)->send($email);
        }
        else{
            $email = new LeaveRejectedMail($leave_status,$user,$reason);
            Mail::to($userMail)->send($email);
        }
    }
}
