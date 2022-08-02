<?php

namespace App\Main\employee;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

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
        $user =auth()->user();
        $permission = [];
        if(isset($user))
        {
            if ($user->hasPermissionTo('employee-dashboard')) {
                $permission[] = [
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
            if ($user->hasPermissionTo('attendance-module')) {
                $permission[] = [
                    'Attendance' => [
                        'icon' => 'calendar',
                        'route_name' => 'attendance-module',
                        'title' => 'Attendance',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                    ],
                ];
            }
            if ($user->hasPermissionTo('task-list')) {
                $permission[] = [
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
            if ($user->hasPermissionTo('team-task')) {
                $permission[] = [

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
            if ($user->hasPermissionTo('team-attendance')) {
                $permission[] = [
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
                            ],
                        ],
                    ],
                ];
            }
            if ($user->hasPermissionTo('project-list')) 
            {
                $permission[] = [
                    'Add Project' => [
                        'icon' => 'home',
                        'route_name' => 'project-list',
                        'title' => 'Add Project',
                        'params' => [
                            'layout' => 'side-menu',
                                 ],
                         ],    
                   ];
            }
            if ($user->hasPermissionTo('employee-list')) 
             {
            $permission[] = [
                'Employee Management' => [
                'icon' => 'user',
                'title' => 'Employee Management',
                'sub_menu' => [
                    'Employee List' => [
                        'icon' => '',
                        'route_name' => 'employeelist',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Employee List'
                    ],
                ]
            ],    
            ];
        }
        if ($user->hasPermissionTo('permission-detail')) {
            $permission[] = [

                'Team Task' => [
                    'icon' => 'twitch',
                    'route_name' => 'permission',
                    'title' => 'Permission Detail',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                ],
            ];
        }
            $permission[] = [
                'Employee Attendance' => [
                    'icon' => 'calendar',
                    'title' => 'Employee Attendance',
                    'sub_menu' => [
                        'Employee List' => [
                            'icon' => '',
                            'route_name' => 'attendancelist',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Attendance List'
                        ],
                        [
                            'icon' => '',
                            'route_name' => 'absentlist',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Absent List'
                        ],
                        [
                            'icon' => '',
                            'route_name' => 'permissionlist',
                            'params' => [
                                'layout' => 'side-menu',
                            ],
                            'title' => 'Permission List'
                        ],
                    ]
                ],  
             ];
            $permissions = Arr::collapse($permission);
            return $permissions;

        }
    }
}
