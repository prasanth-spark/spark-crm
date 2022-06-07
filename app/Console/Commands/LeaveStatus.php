<?php

namespace App\Console\Commands;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Mail\AbsentStatus;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class LeaveStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:absent';

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
            $absenteses = Attendance::where('status', 0)->get();
            foreach($absenteses as $absentese){
                $user = User::find($absentese->user_id);
                $userMail = $user->email;
                 $leaveStatus = LeaveRequest::create([
                'leave_type_id'=>6,
                'permission_type_id'=>null ,
                'user_id'=>$absentese->user_id,
                'description'=>'Absent',
                'permission_status'=>null,
                'leave_status'=>null,
                'permission_hours_from'=>null,
                'permission_hours_to'=>null, 
                'start_date'=>$date,
                'end_date'=>$date,
                'leave_counts'=>1,
                ]);
                Attendance::where('user_id',$leaveStatus->user_id)
                ->where('date','=',$leaveStatus->start_date)
                ->update([    
                    'attendance_status'=>0,           
                    'status'=>1,
                ]);
                Mail::to($userMail)->send(new AbsentStatus($user));
            }    
        
            
    }
             
}
