<?php

namespace App\Main\employee;

use App\Models\UserDetails;
use Illuminate\Support\Facades\Session;

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
        $user = !empty(auth()->user()) ? auth()->user()->userDetail : null;
        if ($user) {
            if ($user->role_id == 3) {
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Dashboard',
                        'route_name' => 'employee-dashboard',
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
                    'Task' => [
                        'icon' => 'home',
                        'route_name' => 'task-list',
                        'title' => 'Task',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                    'Team Task' => [
                        'icon' => 'home',
                        'route_name' => 'team-task',
                        'title' => 'Team Task',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                    'Team Attendance' => [
                        'icon' => 'home',
                        'title' => 'Team Attendance',
                        'sub_menu' => [
                            'Team Attendance' => [
                                'icon' => '',
                                'route_name' => 'attendance',
                                'params' => [
                                    'layout' => 'side-menu',
                                ],
                                'title' => 'Team Attendance'
                            ],
                            'Team Attendance List' => [
                                'icon' => '',
                                'route_name' => 'team-absent',
                                'params' => [
                                    'layout' => 'side-menu',
                                ],
                                'title' => 'Team Absent'
                            ],
                            'Team Permission List' => [
                                'icon' => '',
                                'route_name' => 'team-permission',
                                'params' => [
                                    'layout' => 'side-menu',
                                ],
                                'title' => 'Team Permission'
                            ]
                        ]
                    ],
                ];
            } elseif ($user->role_id == 2) {
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Dashboard',
                        'route_name' => 'employee-dashboard',
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
                    'Add Project' => [
                        'icon' => 'home',
                        'route_name' => 'project-list',
                        'title' => 'Add Project',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                ];
            } else {
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Dashboard',
                        'route_name' => 'employee-dashboard',
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
                    'Task' => [
                        'icon' => 'home',
                        'route_name' => 'task-list',
                        'title' => 'Task',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                ];
            }
        } else {
            return [
                'dashboard' => [
                    'icon' => 'home',
                    'title' => 'Dashboard',
                    'route_name' => 'employee-dashboard',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                ],

            ];
        }
    }
}
