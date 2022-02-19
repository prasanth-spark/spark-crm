<?php

namespace App\Console\Commands;
use App\Models\User;
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
            $id = User::where('id')->first();
            $user = Attendance::where('user_id',$id)
            ->update(['attendance_status'=>0,'status'=>1]);      
    }
             
}
