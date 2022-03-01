<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserDetails;
use App\Mail\BirthdayReminder;
use Illuminate\Support\Facades\Mail;


class DailyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:mail';

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
        $employees = UserDetails::whereMonth('date_of_birth', '=', date('m'))->whereDay('date_of_birth', '=', date('d'))->with('user')->get(); 

         foreach($employees as $employee)
         {
            Mail::to($employee->user->email)->send(new BirthdayReminder($employee));
            
         }

    }
}
