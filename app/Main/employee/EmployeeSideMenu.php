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
<<<<<<< HEAD
<<<<<<< HEAD
                        'route_name' => 'user-dashboard',
=======
                        'route_name' => 'dashboard-overview-1',
>>>>>>> 2213201312bbd6e2914af7e908f1de92e5793887
=======
                        'route_name' => 'dashboard-overview-1',
>>>>>>> 440563f032521023db160824284242fc07e7ea0e
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 2'
                    ],
                    'dashboard-overview-3' => [
                        'icon' => '',
<<<<<<< HEAD
<<<<<<< HEAD
                        'route_name' => 'user-dashboard',
=======
                        'route_name' => 'dashboard-overview-1',
>>>>>>> 2213201312bbd6e2914af7e908f1de92e5793887
=======
                        'route_name' => 'dashboard-overview-1',
>>>>>>> 440563f032521023db160824284242fc07e7ea0e
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 3'
                    ]
                ]
            ],
            'Task' => [
                'icon' => 'home',
                'route_name' => 'task-list',
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
