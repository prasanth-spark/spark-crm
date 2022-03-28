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
            'leave_type' => 'Permission',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
            'id' => '2',
            'leave_type' => 'Half day',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
            'id' => '3',
            'leave_type' => 'Medical leave',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
            'id' => '4',
            'leave_type' => 'Celebration leave',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
            'id' => '5',
            'leave_type' => 'Death leave',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
            'id' => '6',
            'leave_type' => 'Absent',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
     ]); 
    }
}
