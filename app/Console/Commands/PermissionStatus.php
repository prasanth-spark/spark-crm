<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LeaveRequest;
use App\Models\Attendance;

class PermissionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permission Status';

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
        $leaveRequest = LeaveRequest::where('leave_status',4)->with('userAttendance')->get();
       foreach($leaveRequest as $permissionStatus){
        $userId =  $permissionStatus->userAttendance->id;

          Attendance::where('user_id',$userId)->update([
            'attendance_status'=>0,

        ]);
        LeaveRequest::where('user_id',$userId)
            ->update([
                'leave_type_id'=>4,
                'permission_type_id'=>6,
                'permission_status'=>3,           
            ]);

       } 
       
    }
}
