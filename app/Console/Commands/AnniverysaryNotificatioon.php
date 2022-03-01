<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserDetails;
use App\Mail\AnniverysaryReminder;
use Illuminate\Support\Facades\Mail;

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
        $employees = UserDetails::whereMonth('joined_date', '=', date('m'))->whereDay('joined_date', '=', date('d'))->with('user')->get(); 
         foreach($employees as $employee)
         {            
            Mail::to($employee->user->email)->send(new AnniverysaryReminder($employee));    
         }   
    }
}
