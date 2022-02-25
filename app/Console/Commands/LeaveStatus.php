<?php

namespace App\Console\Commands;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use Illuminate\Console\Command;
use Carbon\Carbon;

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
            $date = $date->format("d-m-Y");
            $user = Attendance::where('attendance_status','0')->where('leave_status','0')->where('status','0')->get();
            foreach($user as $absentese){
                // dd($absentese->user_id);
                 $leaveStatus = LeaveRequest::create([
                'leave_type_id'=>4,
                'user_id'=>$absentese->user_id,
                'description'=>'absent',
                'status'=>1,
                'start_date'=>$date,
                'end_date'=>$date
                ]);
                Attendance::where('user_id',$leaveStatus->user_id)
                ->where('date','=',$leaveStatus->start_date)
                ->update([    
                    'attendance_status'=>2,           
                    'status'=>1,
                ]);
            }    
    }
             
}
