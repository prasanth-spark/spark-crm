<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Mail\AnniverysaryReminder;
use Mail;

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
        $employees = Employee::whereMonth('joined_date', '=', date('m'))->whereDay('joined_date', '=', date('d'))->get(); 

         foreach($employees as $employee)
         {
            Mail::to($employee->email)->send(new AnniverysaryReminder($employee));    
         }   
    }
}
