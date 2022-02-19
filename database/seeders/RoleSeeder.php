<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [ 
                'id' => '1',
                'role' => 'Project Manager',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
        ],
        [ 
            'id' => '2',
            'role' => 'Team Leader',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
    [ 
        'id' => '3',
        'role' => 'Employee',
        'status'=>'1',
        'created_at' =>now(),
        'updated_at' =>now()           
]
        ]);
    }
}
