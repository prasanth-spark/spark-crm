<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{

     /**
     * @var array[]
     */
    protected $permissions = [
        [
            'group_name' => 'employee',
            'menu_list' => [
                ['name' => 'employee-dashboard', 'menu_name' => 'dashboard'],
                ['name' => 'task-list', 'menu_name' => 'task-list'],

                ['name' => 'attendance-module', 'menu_name' => 'attendance-module'],
                ['name' => 'leave-response', 'menu_name' => 'leave-response'],
                ['name' => 'permission-response', 'menu_name' => 'permission-response'],
                ['name' => 'attendance-show', 'menu_name' => 'attendance-show'],

                ['name' => 'user-profile', 'menu_name' => 'user-profile-form'],

                ['name' => 'team-task', 'menu_name' => 'team-task'],
                ['name' => 'team-attendance', 'menu_name' => 'attendance'],
                
                ['name' => 'project-list', 'menu_name' => 'project-list'],

            ]
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $group) {

            foreach ($group['menu_list'] as $menu) {
                Permission::updateOrCreate(
                    [
                        'name' => $menu['name'],
                        'guard_name' => 'web'
                    ],
                    [
                        'group_name' => $group['group_name'],
                        'menu_name' => $menu['menu_name']
                    ]
                );
            }
        }
    }
}
