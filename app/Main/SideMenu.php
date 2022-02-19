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
                'icon' => 'home',
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
            'Attendance' => [
                'icon' => 'calendar',
                'route_name' => 'admin-attendance-module',
                'title' => 'Attendance',
                'params' => [
                'layout' => 'side-menu',
                    ],
            ]       
        ];
    }
}
