<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\LeaveStatusMail;
use Illuminate\Support\Facades\Mail;

class LeaveMailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user,$status;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$status)
    {
        $this->user = $user;
        $this->status = $status; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user= $this->user;
        $userMail = $user->email;
        $status= $this->status;
        if($status == 2){
            $status = 'Accepted' ;
        }
        else 
        {
            $status = 'Rejected'; 
        }
        $email = new LeaveStatusMail($user,$status);
        Mail::to($userMail)->send($email);

    }
}
