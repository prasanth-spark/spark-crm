<?php

namespace App\Console\Commands;
use App\Models\Attendance;

use Illuminate\Console\Command;

class LeaveStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leave:status';

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
            
            $user = Attendance::where('attendance_status','0')
            ->where('leave_status','0')->where('status','0')->get();
            foreach($user as $absentese){
                Attendance::updateOrCreate([
                'user_id'=>$absentese->id,
                'attendance_status'=>'0',
                'leave_status'=>'0',
                'status'=>'0'
                ]);
            }    
    }
             
}
