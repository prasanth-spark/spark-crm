<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class AttendanceRemainder extends Mailable
{
    use Queueable, SerializesModels;
    protected $userValue;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userValue)
    {
        $this->userValue =$userValue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userValue=$this->userValue;
        return $this->subject('Attendance Remainder')
        ->view('employee/email/attendance_remainder',compact('userValue'));
    }
}
