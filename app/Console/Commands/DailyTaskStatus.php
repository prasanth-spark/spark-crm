<?php

namespace App\Console\Commands;

use App\Mail\TaskRemainderMail;
use App\Models\Attendance;
use App\Models\TaskSheet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyTaskStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Daily:TaskStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Task status';

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
        $date =$date->format('Y-m-d');
        $task = TaskSheet::where('date',$date)->pluck('user_id')->toArray();
       
        $users = User::where('status',1)->pluck('id','name')->toArray();
        $taskNotUpdatedUsers = array_diff($users,$task);
        
        foreach($taskNotUpdatedUsers as $taskNotUpdatedUser){
            $userTask = User::find($taskNotUpdatedUser);
            $userMail = $userTask->email;
            $userName=$userTask->name;
            $attendance = Attendance::where('user_id',$taskNotUpdatedUser)->first();
            $attendanceStatus = isset($attendance->attendance_status)?$attendance->attendance_status:0;
            
            if($attendanceStatus == 1){
                
                Mail::to($userMail)->send(new TaskRemainderMail($userName));
            }
        }
    }
}
