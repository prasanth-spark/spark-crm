<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PermissionAcceptanceMail;
use App\Mail\PermissionRejectedMail;
use Illuminate\Support\Facades\Mail;

class PermissionResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $permission_status,$user,$reason;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($permission_status,$user,$reason)
    {
        $this->permission_status=$permission_status;
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
        $permission_status= $this->permission_status;
        $user= $this->user;
        $reason = $this->reason;
        $userMail = $user->email;
        if($permission_status == 2){
            $email = new PermissionAcceptanceMail($user,$permission_status);
            Mail::to($userMail)->send($email);
        }
        else{
            $email = new PermissionRejectedMail($user,$reason);
            Mail::to($userMail)->send($email);
        }
    }
}
