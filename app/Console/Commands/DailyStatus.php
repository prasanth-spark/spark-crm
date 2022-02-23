<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;

class DailyStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daly Status';

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
        $id = User::where('id','51ac94b0-d4a8-4c70-849a-04342d75acff')->first();
        Attendance::where('user_id',$id->id)->update(['status'=> 0]);
    }
}
