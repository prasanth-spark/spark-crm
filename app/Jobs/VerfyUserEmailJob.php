<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\VerfyEmployeeMail;
use Illuminate\Support\Facades\Mail;

class VerfyUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $userCredentials,$password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userCredentials,$password)
    {
        $this->userCredentials = $userCredentials;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->userCredentials;
        $password = $this->password;
        Mail::to($user->email)->send(new  VerfyEmployeeMail($user,$password));
    }
}
