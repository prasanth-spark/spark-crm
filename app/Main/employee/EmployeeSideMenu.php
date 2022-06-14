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
            if ($user->role_id == 6) {
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
                        'icon' => 'calendar',
                        'route_name' => 'attendance-module',
                        'title' => 'Attendance',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                    'Task' => [
                        'icon' => 'type',
                        'route_name' => 'task-list',
                        'title' => 'Task',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                    'Team Task' => [
                        'icon' => 'twitch',
                        'route_name' => 'team-task',
                        'title' => 'Team Task',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                    'Team Attendance' => [
                        'icon' => 'calendar',
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
            }elseif ($user->role_id == 5) {
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
                        'icon' => 'calendar',
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
            } elseif ($user->role_id == 4) {
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
                        'icon' => 'calendar',
                        'route_name' => 'attendance-module',
                        'title' => 'Attendance',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                    'Add Project' => [
                        'icon' => 'user-plus',
                        'route_name' => 'project-list',
                        'title' => 'Add Project',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                    'Team Task' => [
                        'icon' => 'twitch',
                        'route_name' => 'team-task',
                        'title' => 'Team Task',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                ];
            } 
             elseif ($user->role_id == 3) {
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
                        'icon' => 'calendar',
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
                    'Team Task' => [
                        'icon' => 'twitch',
                        'route_name' => 'team-task',
                        'title' => 'Team Task',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                ];
            } 
            elseif($user->role_id == 2) {
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
                        'icon' => 'calendar',
                        'route_name' => 'attendance-module',
                        'title' => 'Attendance',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],  
                    'Attendance List' => [
                        'icon' => 'calendar',
                        'title' => 'Employee Attendance',
                        'sub_menu' => [
                            'Employee Attendance' => [
                                'icon' => '',
                                'route_name' => 'attendance',
                                'params' => [
                                    'layout' => 'side-menu',
                                ],
                                'title' => 'Employees Present List'
                            ],
                            'Employee Attendance List' => [
                                'icon' => '',
                                'route_name' => 'team-absent',
                                'params' => [
                                    'layout' => 'side-menu',
                                ],
                                'title' => 'Employees Absent List'
                            ],
                            'Employee Permission List' => [
                                'icon' => '',
                                'route_name' => 'team-permission',
                                'params' => [
                                    'layout' => 'side-menu',
                                ],
                                'title' => 'Employees Permission List'
                            ]
                        ]
                    ],
                ];
            }
            else {
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
                        'icon' => 'calendar',
                        'route_name' => 'attendance-module',
                        'title' => 'Attendance',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                    'Task' => [
                        'icon' => 'type',
                        'route_name' => 'task-list',
                        'title' => 'Task',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                ];
            }
        } 
    }
}
