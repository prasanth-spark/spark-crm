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
                ['name' => 'employee-logout', 'menu_name' => 'logout'],
                ['name' => 'task-form', 'menu_name' => 'task-view'],
                ['name' => 'task-add', 'menu_name' => 'task-add'],
                ['name' => 'task-list', 'menu_name' => 'task-list'],

                ['name' => 'attendance-module', 'menu_name' => 'attendance-module'],
                ['name' => 'attendance-status', 'menu_name' => 'attendance-status'],
                ['name' => 'leave-response', 'menu_name' => 'leave-response'],
                ['name' => 'leave-status', 'menu_name' => 'leave-status'],
                ['name' => 'permission-response', 'menu_name' => 'permission-response'],
                ['name' => 'permission-status', 'menu_name' => 'permission-status'],
                ['name' => 'leave-accepted', 'menu_name' => 'leave-accepted'],
                ['name' => 'attendance-show', 'menu_name' => 'attendance-show'],

                ['name' => 'user-profile-form', 'menu_name' => 'user-profile-form'],
                ['name' => 'user-profile-add', 'menu_name' => 'user-profile-add'],
                ['name' => 'user-reset-password', 'menu_name' => 'user-reset-password'],
                ['name' => 'user-change-password', 'menu_name' => 'user-change-password'],

                ['name' => 'team-task', 'menu_name' => 'team-task'],
                ['name' => 'attendance', 'menu_name' => 'attendance'],
                ['name' => 'team-absent', 'menu_name' => 'team-absent'],
                ['name' => 'team-permission', 'menu_name' => 'team-permission'],   
                
                ['name' => 'project-list', 'menu_name' => 'project-list'],
                ['name' => 'project-form', 'menu_name' => 'project-form'],
                ['name' => 'add-project-form', 'menu_name' => 'add-project-form'],
                ['name' => 'edit-project', 'menu_name' => 'edit-project'],
                ['name' => 'update-project', 'menu_name' => 'update-project'],
                ['name' => 'delete-project', 'menu_name' => 'delete-project'],

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
