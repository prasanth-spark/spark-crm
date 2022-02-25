<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_status')->insert([
            [
            'id' => 1,
            'task_status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'task_status' => 'completed',
            'created_at' => now(),
            'updated_at' => now()
        ]
        ]);
    }
}
