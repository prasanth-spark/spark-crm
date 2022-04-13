<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleModel;

class RoleSeeder extends Seeder
{

/**
     * @var array[]
     */
    protected $roles = [
        [
            'name' => 'Admin'
        ],
        [
            'name' => 'Project Manager'
        ],
        [
            'name' => 'Team Leader'
        ],
        [
            'name' => 'Employee'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            RoleModel::firstOrCreate(
                [
                    'name' => $role['name'],
                    'guard_name' => 'web'
                ]
            );
        }
    }
  
}
