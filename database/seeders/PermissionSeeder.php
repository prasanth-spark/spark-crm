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
                ['name' => 'task-view', 'menu_name' => 'task-view'],
                ['name' => 'task-add', 'menu_name' => 'task-add'],
                ['name' => 'task-edit', 'menu_name' => 'task-edit'],

                ['name' => 'attendance-module', 'menu_name' => 'attendance-module'],
                ['name' => 'leave-response', 'menu_name' => 'leave-response'],
                ['name' => 'permission-response', 'menu_name' => 'permission-response'],
                ['name' => 'attendance-show', 'menu_name' => 'attendance-show'],

                ['name' => 'user-profile', 'menu_name' => 'user-profile-form'],

                ['name' => 'team-task', 'menu_name' => 'team-task'],
                ['name' => 'team-attendance', 'menu_name' => 'attendance'],
                
                ['name' => 'project-list', 'menu_name' => 'project-list'],
                ['name' => 'project-add', 'menu_name' => 'project-add'],
                ['name' => 'project-edit', 'menu_name' => 'project-edit'],

                ['name' => 'employee-list', 'menu_name' => 'employee-list'],
                ['name' => 'employee-add', 'menu_name' => 'employee-add'],
                ['name' => 'employee-detail', 'menu_name' => 'employee-detail'],
                ['name' => 'employee-edit', 'menu_name' => 'employee-edit'],
                ['name' => 'employee-delete', 'menu_name' => 'employee-delete'],

                ['name' => 'permission-detail', 'menu_name' => 'permission-detail'],
                ['name' => 'permission-approvel', 'menu_name' => 'permission-approvel'],
                ['name' => 'permission-deny', 'menu_name' => 'permission-deny'],

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
