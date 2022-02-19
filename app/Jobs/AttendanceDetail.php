<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Mail\PermissionMail;
use App\Mail\LeaveMail;
use Illuminate\Support\Facades\Mail;



class AttendanceDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($leave_type,$userDetail,$status)
    {
        $this->leave_type=$leave_type;
        $this->userDetail =$userDetail;
        $this->status=$status;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $leaveType =$this->leave_type;
        $userId=$this->userDetail->id;
        $user = User::where('id',$userId)->first();
        $userTeam = $user->team_id;
        $userRole = $user->role_id;
            



        
        if($leaveType==1){    
          $email = new PermissionMail();
          Mail::to($this->userDetail['email'])->send($email);
        }
        else{
            // $email = new LeaveMail();
            // Mail::to($this->userDetail['email'])->send($email);      
        }

    }
}
