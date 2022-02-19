<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\VerfyEmployeeMail;
use Mail;

class VerfyUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $userCredentials;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userCredentials)
    {
        $this->userCredentials = $userCredentials;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->userCredentials;
        Mail::to($user->email)->send(new  VerfyEmployeeMail($user));
    }
}
