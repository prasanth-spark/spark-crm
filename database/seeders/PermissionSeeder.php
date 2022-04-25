<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;


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
                ['name' => 'taskDetails', 'menu_name' => 'taskDetails'],
                ['name' => 'taskEdit', 'menu_name' => 'taskEdit'],
                ['name' => 'taskUpdate', 'menu_name' => 'taskUpdate'],
                ['name' => 'taskPagination', 'menu_name' => 'taskPagination'],

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
