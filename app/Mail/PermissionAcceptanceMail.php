<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PermissionAcceptanceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user,$permission_status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$permission_status)
    {
        $this->user=$user;
        $this->permission_status=$permission_status;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $permission_status =$this->permission_status;
        $user = $this->user;
        return $this->subject('Permission Accepted')
        ->view('employee/email/permission_accepted',compact('user'));
    }
}
