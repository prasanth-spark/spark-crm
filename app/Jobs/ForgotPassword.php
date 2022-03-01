<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;

class ForgotPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public  $employeer,$details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($employeer,$details)
    {
        $this->details=$details;
        $this->employeer=$employeer;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $employee=$this->employeer;
        $details=$this->details;
        Mail::to($employee->email)->send(new ResetPassword($details));
    }
}
