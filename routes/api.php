<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\employee\LoginController;
use App\Http\Controllers\api\employee\AttendanceController;
use App\Http\Controllers\api\employee\TaskController;
use App\Http\Controllers\api\employee\ProjectAssignController;
use App\Http\Controllers\api\employee\TeamAttendanceController;
use App\Http\Controllers\api\employee\UserProfileController;
use App\Http\Controllers\api\employee\TeamTaskController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

       //Login and Logout

        Route::post('/login-employee', [LoginController::class, 'loginEmployee']);

     
        Route::group(['namespace'=>'api'], function(){

        //Attendance

        Route::post('attendance-status',[AttendanceController::class,'attendanceStatus']);

        //Task 
        
        Route::post('/task-add',[TaskController::class, 'taskAdd']);
        Route::post('/task-Details',[TaskController::class, 'taskDetails']);
        Route::post('/assigned-Project',[TaskController::class, 'assignedProject']);
        Route::post('/task-update',[TaskController::class, 'taskUpdate']);

        //Project Manager Add Project Details

        Route::post('/project-list',[ProjectAssignController::class, 'projectList']);
        Route::get('/project-member',[ProjectAssignController::class, 'projectForm']);
        Route::post('/project-add',[ProjectAssignController::class, 'projectAdd']);
        Route::post('/project-update',[ProjectAssignController::class, 'projectUpdate']);
        Route::post('/project-delete',[ProjectAssignController::class, 'projectDelete']);

        //Team Attendance
        Route::post('team-attendance',[TeamAttendanceController::class, 'teamAttendanceList']);

        //Team Absent 
        Route::post('team-absent',[TeamAttendanceController::class, 'teamAbsentlist']);

        //Team Permission
        Route::post('team-permission',[TeamAttendanceController::class, 'teamPermissionlist']);

        //Team Task
        Route::post('team-task',[TeamTaskController::class, 'teamTask']);

        // User Profile
        Route::post('user-detail',[UserProfileController::class, 'userDetail']);
        Route::post('user-detail-add',[UserProfileController::class, 'userProfileAdd']);
        Route::post('user-password-change',[UserProfileController::class, 'userChangePassword']);

        //Team Lead Response
        Route::post('leave-status',[AttendanceController::class, 'leaveStatus']);
        Route::post('permission-status',[AttendanceController::class, 'permissionStatus']);
        Route::post('leave-list',[AttendanceController::class, 'attendanceList']);

});
 

