<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ApprovedMail;
use Illuminate\Support\Facades\Mail;

class AdminApproved implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $adminApprovedMail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($adminApprovedMail)
    {
        $this->adminApprovedMail=$adminApprovedMail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $approved = $this->adminApprovedMail;
        Mail::to($approved->email)->send(new  ApprovedMail($approved));
    }
}
