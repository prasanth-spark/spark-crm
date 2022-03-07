<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DailyNotification::class,
        Commands\AnniverysaryNotificatioon::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->command('birthday:mail')->daily();
        $schedule->command('anniverysary:mail')->daily();
        $schedule->command('permission:status')->weekdays()->hourly();
        $schedule->command('permission:check')->weekdays()->hourly();
        $schedule->command('attendance:status')->weekdays()->at('10:00');
        $schedule->command('attendance:leave')->weekdays()->at('11:00');
        $schedule->command('Daily:TaskStatus')->weekdays()->at('11:10');


      

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
