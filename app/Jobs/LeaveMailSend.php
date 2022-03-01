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
    public $status,$user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($status,$user)
    {
        $this->status = $status; 
        $this->user = $user;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $status= $this->status;
        $user= $this->user;
        $userMail = $user->email;
        $email = new LeaveStatusMail($status,$user);
        Mail::to($userMail)->send($email);

    }
}
