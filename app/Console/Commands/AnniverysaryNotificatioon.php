<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserDetails;
use App\Models\User;
use App\Mail\AnniverysaryReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AnniverysaryNotificatioon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anniverysary:mail';

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
        $userEmail=User::where('role_id','!=',1)->get();
         foreach($userEmail as $employee)
         {
            $employees = UserDetails::where('user_id',$employee->id)->whereMonth('joined_date', '=', date('m'))->whereDay('joined_date', '=', date('d'))->first(); 
            dd($employees);

            dd($employee->email);
            Mail::to($employee->email)->send(new AnniverysaryReminder($employee));    
         }   
    }
}
