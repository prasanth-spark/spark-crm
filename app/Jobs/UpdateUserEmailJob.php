<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\UpdateUserMail;
use Illuminate\Support\Facades\Mail;

class UpdateUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $updateCredentials;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($updateCredentials)
    {
        $this->updateCredentials = $updateCredentials;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->updateCredentials;
        Mail::to($user->email)->send(new  UpdateUserMail($user));
    }
}
