<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionType;

class PermissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionType::insert([
            [ 
                'id' => '1',
                'permission_hours' => '0-1 hour',
                'status'=>1,
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '2',
                'permission_hours' => '1-2 hours',
                'status'=>1,
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '3',
                'permission_hours' => '2-3 hours',
                'status'=>1,
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '4',
                'permission_hours' => '3-4 hours',
                'status'=>1,
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '5',
                'permission_hours' => 'permission time overed',
                'status'=>1,
                'created_at' =>now(),
                'updated_at' =>now()           
            ]
         ]); 
    }
}
