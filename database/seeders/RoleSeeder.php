<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleModel;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleModel::insert([
            [ 
                'id' => '1',
                'role' => 'Admin',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'id' => '2',
                'role' => 'Project Manager',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '3',
                'role' => 'Team Leader',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '4',
                'role' => 'Employee',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
        ]);
    }
}
