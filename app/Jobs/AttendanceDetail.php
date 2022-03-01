<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PermissionMail;
use App\Mail\LeaveMail;
use Illuminate\Support\Facades\Mail;



class AttendanceDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $leave,$user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($leave,$user)
    {
        $this->leave=$leave;
        $this->user =$user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {  
        $user=$this->user;
        $leave =$this->leave;
        $sendMailTo= $user->email;     
        $reason = $leave->description;

        if($reason=='Permission'){    
          $email = new PermissionMail($user,$leave);
          Mail::to($sendMailTo)->send($email);
        }
        else{
            $email =new LeaveMail($user);
            Mail::to($sendMailTo)->send($email);   
        }
    }
}
