<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard-overview-1' => [
                        'icon' => '',
                        'route_name' => 'dashboard-overview-1',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 1'
                    ],
                ]
            ],
            'Employee Management' => [
                'icon' => 'user',
                'title' => 'Employee Management',
                'sub_menu' => [
                    'Employee List' => [
                        'icon' => '',
                        'route_name' => 'employee-list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Employee List'
                    ],
                ]
            ],    
            'Employee Attendance' => [
                'icon' => 'calendar',
                'title' => 'Employee Attendance',
                'sub_menu' => [
                    'Employee List' => [
                        'icon' => '',
                        'route_name' => 'attendance-list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Attendance List'
                    ],
                    [
                        'icon' => '',
                        'route_name' => 'absent-list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Absent List'
                    ],
                    [
                        'icon' => '',
                        'route_name' => 'permission-list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Permission List'
                    ],
                ]
            ],  
            'Employee Task' => [
                'icon' => 'twitch',
                'title' => 'Employee Task',
                'sub_menu' => [
                    'Employee List' => [
                        'icon' => '',
                        'route_name' => 'employee-task-list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Task List'
                    ],
                ]
            ],   
            'Language' => [
                'icon' => 'menu',
                'route_name' => 'language-list',
                'title' => 'Language',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'Roles' => [
                'icon' => 'menu',
                'route_name' => 'employee-role',
                'title' => 'Roles',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
        ];
    }
}
