<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveRequest;
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
        $userId = User::where('role_id','!=',1)->pluck('id')->toArray();
  
        $attendance = Attendance::where('date',$date)->pluck('user_id')->toArray();
    
        $attendanceNotUpdatedUser = array_diff($userId,$attendance);

        $missedIds = [];
        foreach($attendanceNotUpdatedUser as $attendanceUpdatedUser){
     
        $user= User::where('users.id',$attendanceUpdatedUser)
        ->join('leave_requests','leave_requests.user_id','=','users.id')
        ->select('leave_requests.*','users.email')->first();
        // dd($user); 
            if(is_null($user)){
                array_push($missedIds,$attendanceUpdatedUser);
            }else{
                $expire = $user->end_date;    
                $today_time = strtotime($date);
                $expire_time = strtotime($expire);
                $userMail = $user->email;
         if($user->leave_type_id!=1 && $user->leave_type_id=2 && $expire_time >= $today_time) {
            Attendance::create([
                'user_id'=>$user->user_id,
                'attendance'=>0,
                'date'=>$date,
                'attendance_status'=>2,
                'in_active'=>2,
                'status'=> 1
        ]);
          LeaveRequest::create([
            'leave_type_id'=> $user->leave_type_id,
            'permission_type_id'=>null ,
            'user_id' =>$user->user_id,
            'description'=>'Leave',
            'permission_status'=>null, 
            'leave_status'=>0,
            'permission_hours_from'=>null,
            'permission_hours_to'=>null,   
            'start_date'=>$user->start_date,
            'end_date'=>$user->end_date,
            'leave_counts'=>$user->leave_counts,
         ]);
        }
        else{
            
            Attendance::create([
                'user_id'=>$user->user_id,
                'attendance'=>0,
                'date'=>$date,
                'attendance_status'=>0,
                'in_active'=>2,
                'status'=> 0
            ]);
            Mail::to($userMail)->send(new AttendanceRemainder($user));
        }
            }
    
        }  
// dd($missedIds);
                foreach($missedIds as $absentese){
                    $userValue = User::find($absentese);
                    $userMail = $userValue->email;
                    Attendance::create([
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