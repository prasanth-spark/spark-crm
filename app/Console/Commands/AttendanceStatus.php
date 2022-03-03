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
        $date = $date->format("Y-m-d");
        $user = User::where('role_id','!=',1)->pluck('id')->toArray();
        $attendance = Attendance::pluck('user_id')->toArray();
        $attendanceNotUpdatedUser = array_diff($user,$attendance);
    
        foreach($attendanceNotUpdatedUser as $attendanceUpdatedUser){
            $users= user::where('id',$attendanceUpdatedUser)->with('userLeaveRequest')->get();
        foreach($users as $userValue){
            $userMail= $userValue->email;
            // dd($userMail);
            if(isset($userValue->userLeaveRequest->user_id)){
          $leaveDays = $userValue->userLeaveRequest->end_date;
          if($leaveDays <= $date){
            $attendance =   $this->attendance->create([
                'user_id'=>$userValue->id,
                'attendance'=>0,
                'date'=>$date,
                'attendance_status'=>2,
                'in_active'=>2,
                'status'=> 1
            ]);
            $leave = $this->leave_request->create([               
                'leave_type_id'=> $userValue->userLeaveRequest->leave_type_id,
                'permission_type_id'=>null ,
                'user_id' =>$userValue->id,
                'description'=>'Leave',
                'permission_status'=>null, 
                'leave_status'=>0,
                'permission_hours_from'=>null,
                'permission_hours_to'=>null,   
                'start_date'=>$userValue->userLeaveRequest->start_date,
                'end_date'=>$userValue->userLeaveRequest->end_date,
                'leave_counts'=>$userValue->userLeaveRequest->leave_counts,
            ]);
       } else{
        
                $attendance =   $this->attendance->create([
                    'user_id'=>$userValue->id,
                    'attendance'=>0,
                    'date'=>$date,
                    'attendance_status'=>2,
                    'in_active'=>2,
                    'status'=> 0
                ]);
        Mail::to($userMail)->send(new AttendanceRemainder($userValue));
          }

    }
       else{
        $attendance =   $this->attendance->create([
            'user_id'=>$userValue->id,
            'attendance'=>0,
            'date'=>$date,
            'attendance_status'=>2,
            'in_active'=>2,
            'status'=> 0
        ]);
        Mail::to($userMail)->send(new AttendanceRemainder($userValue));
          }
        }
      }
    }
}