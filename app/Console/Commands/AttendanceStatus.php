<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use App\Mail\AttendanceRemainder;
use Illuminate\Support\Facades\Mail;

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
        $id = User::where('id')->first();
        $user = Attendance::where('user_id',$id)->first();
        $status = $user->status;
        if($status==0){
            Mail::to($user->email)->send(new AttendanceRemainder($user));
        }   
   
    }
}
