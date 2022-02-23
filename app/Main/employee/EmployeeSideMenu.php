<?php

namespace App\Main\employee;

class EmployeeSideMenu
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
                    'dashboard-overview-2' => [
                        'icon' => '',
                        'route_name' => 'user-dashboard',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 2'
                    ],
                    'dashboard-overview-3' => [
                        'icon' => '',
                        'route_name' => 'user-dashboard',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 3'
                    ]
                ]
            ],
            'Task' => [
                'icon' => 'home',
                'route_name' => 'dashboard-overview-1',
                'title' => 'Task',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'Attendance' => [
                'icon' => 'home',
                'route_name' => 'attendance-module',
                'title' => 'Attendance',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            
        ];
    }
}
