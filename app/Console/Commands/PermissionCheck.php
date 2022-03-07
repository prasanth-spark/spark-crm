<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LeaveRequest;
use App\Mail\PermissionRemainderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PermissionCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:check';

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
        $time = Carbon::now()->format('Y-m-d H:i:s');
        $time = date('H:i', strtotime($time));
        $leaveRequest= LeaveRequest::where(['leave_type_id' =>1,'start_date' => $date])->with('userAttendance')->get();
        foreach($leaveRequest as $permissionCheck){   
            $userName=$permissionCheck->userAttendance->name;
            $userMail=$permissionCheck->userAttendance->email;
            $endHours = $permissionCheck->permission_hours_to;
            $permissionStatus= $permissionCheck->permission_status;
             if($endHours<$time || $permissionStatus==2){
                Mail::to($userMail)->send(new PermissionRemainderMail($userName));
             }
        }
    }
}
