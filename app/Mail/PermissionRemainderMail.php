<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PermissionRemainderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        $userName= $this->userName;
        return $this->subject('Permission Remainder')
        ->view('employee/email/permission_remainder',compact('userName'));
    }
}
