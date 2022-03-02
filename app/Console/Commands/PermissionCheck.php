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
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        $time = date('H:i', strtotime($dateTime));  
        $leaveRequest= LeaveRequest::where('leave_type_id',1)->with('userAttendance')->get();
        //  dd($leaveRequest[0]['userAttendance']['email']);
        foreach($leaveRequest as $permissionCheck){
            
            $userName=$permissionCheck->userAttendance->name;
            $userMail=$permissionCheck->userAttendance->email;
            $endHours = $permissionCheck->permission_hours_to;
             if($endHours<$time){
                Mail::to($userMail)->send(new PermissionRemainderMail($userName));
             }
        }
    }
}
