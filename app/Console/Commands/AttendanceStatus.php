<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use App\Mail\AttendanceRemainder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class AttendanceStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $date = $date->format("d-m-Y");
        $user = User::where('status','!=',0)->pluck('id')->toArray();
        $attendance = Attendance::pluck('user_id')->toArray();
        $attendanceNotUpdatedUser = array_diff($user,$attendance);
    
        foreach($attendanceNotUpdatedUser as $attendanceUpdatedUser){
            $userValue = User::find($attendanceUpdatedUser);
            $userMail = $userValue->email;
             Attendance::create([
                'user_id'=>$userValue->id,
                'attendance_status'=>'0',
                'leave_status'=>'0',
                'date'=>$date,
                'status'=>'0']);
                Mail::to($userMail)->send(new AttendanceRemainder($userValue));
        }
    }
}