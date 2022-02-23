<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\DarkModeController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\TaskController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');


Route::middleware('loggedin')->group(function () {
        Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
        Route::post('login-admin',[AuthController::class, 'login'])->name('login');
});
Route::middleware('auth')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [PageController::class, 'dashboardOverview1'])->name('dashboard-overview-1');

        //Admin add Employee
        Route::get('/employee-form', [EmployeeController::class, 'employeeForm'])->name('employee-form');
        Route::post('/employee-add', [EmployeeController::class, 'employeeAdd'])->name('employee-add');
        Route::get('/employee-list', [EmployeeController::class, 'employeeList'])->name('employee-list');
        Route::get('/employee-details/{id}', [EmployeeController::class, 'employeeDetails'])->name('employee-details');
        Route::get('/employee-edit/{id}', [EmployeeController::class, 'employeeEdit'])->name('employee-edit');
        Route::post('/employee-update', [EmployeeController::class, 'employeeUpdate'])->name('employee-update');
        Route::post('/employee-delete', [EmployeeController::class, 'employeeDelete'])->name('employee-delete');

        //Admin add Employee in Excel File
        Route::get('/file-upload', [EmployeeController::class, 'fileUpload'])->name('file-upload');
        Route::post('/employee-list-import', [EmployeeController::class, 'employeeListImport'])->name('employee-list-import');
        Route::get('/employee-list-export', [EmployeeController::class, 'employeeListExport'])->name('employee-list-export');

        //Attendance List
        Route::get('/attendance-list', [AttendanceController::class, 'attendanceList'])->name('attendance-list');
        Route::post('/attendance/team-list',[AttendanceController::class, 'attendanceTeamList'])->name('attendance-teamlist');

        //Task List
        Route::get('/task-list', [TaskController::class, 'taskList'])->name('employee-task-list');
        Route::post('/team/task-list', [TaskController::class, 'taskTeamList'])->name('task-teamlist');



    });



