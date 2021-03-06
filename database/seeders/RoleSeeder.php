<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
            'name' => 'Human Resource'
        ],
        [
            'name' => 'Tech Architect'
        ],
        [
            'name' => 'Project Architect'
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
        [
            'name' => 'Human Resource'
        ],
        [
            'name' => 'Others'
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
            Role::firstOrCreate(
                [
                    'name' => $role['name'],
                    'guard_name' => 'web'
                ]
            );
        }
    }
  
}
