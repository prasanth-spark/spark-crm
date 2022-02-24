<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeaveType::insert([
        [ 
            'id' => '1',
            'leave_type' => 'permission',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
            'id' => '2',
            'leave_type' => 'sick leave',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
            'id' => '3',
            'leave_type' => 'personal_leave',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
            'id' => '4',
            'leave_type' => 'absent',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ]
     ]); 
    }
}
