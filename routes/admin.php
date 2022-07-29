<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\DarkModeController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\PermissionController;

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
        Route::post('login-admin', [AuthController::class, 'login'])->name('login');
        Route::get('login-form-mail/{id}', [EmployeeController::class, 'loginFormMail'])->name('login-view-mail');

});
Route::middleware('auth')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [PageController::class, 'dashboardOverview1'])->name('dashboard-overview-1');
        Route::get('admin-reset-form',[AuthController::class, 'adminResetForm'])->name('admin-reset-password');
        Route::post('admin-change-password',[AuthController::class, 'adminChangePassword'])->name('admin-change-password');

        //Admin add Employee
        Route::get('/employee-form', [EmployeeController::class, 'employeeForm'])->name('employee-form');
        Route::post('/employee-add', [EmployeeController::class, 'employeeAdd'])->name('employee-add');
        Route::get('/employee-list', [EmployeeController::class, 'employeeList'])->name('employee-list');
        Route::get('/employee-details/{id}', [EmployeeController::class, 'employeeDetails'])->name('employee-details');
        Route::get('/employee-edit/{id}', [EmployeeController::class, 'employeeEdit'])->name('employee-edit');
        Route::post('/employee-update', [EmployeeController::class, 'employeeUpdate'])->name('employee-update');
        Route::post('/employee-delete', [EmployeeController::class, 'employeeDelete'])->name('employee-delete');
        Route::get('/new-register-list', [EmployeeController::class, 'newRegisterList'])->name('new-register-list');
        Route::get('/approved/{id}', [EmployeeController::class, 'adminApproved'])->name('admin-approved');
        Route::get('/rejected/{id}', [EmployeeController::class, 'adminRejected'])->name('admin-rejected');
        Route::get('/employee-list-pagination', [EmployeeController::class, 'employeeListPagination'])->name('employee-list-pagination');
       
       //Roles and Permission
        Route::get('/employee-role', [RolesController::class, 'roleList'])->name('employee-role');
        Route::post('/add-role', [RolesController::class, 'addRole'])->name('add-role');
        Route::get('/roles-permission-list/{id}', [RolesController::class, 'rolesPermissionlist'])->name('role-permission-list');
        Route::post('/add-permission-role', [RolesController::class, 'addPermissionrole'])->name('add-permission-role');
        Route::post('/delete-role', [RolesController::class, 'roleDelete'])->name('delete-role');


        Route::get('/permission', [PermissionController::class, 'permissionDetail'])->name('permission-detail');
        Route::post('permission-approvel/',[PermissionController::class, 'permissionApprovel'])->name('permission-approvel');
        Route::post('permission-deny/',[PermissionController::class, 'permissionDeny'])->name('permission-deny');




        //Admin add Employee in Excel File
        Route::get('/file-upload', [EmployeeController::class, 'fileUpload'])->name('file-upload');
        Route::post('/employee-list-import', [EmployeeController::class, 'employeeListImport'])->name('employee-list-import');
        Route::post('/employee-list-import-process', [EmployeeController::class, 'importProcess'])->name('import-process');

        Route::get('/employee-list-export', [EmployeeController::class, 'employeeListExport'])->name('employee-list-export');

        //Attendance List
        Route::get('/attendance-list', [AttendanceController::class, 'attendanceList'])->name('attendance-list');
        Route::get('/attendance-list-pagination', [AttendanceController::class, 'attendanceListPagination'])->name('attendance-list-pagination');


        //Absent List
        Route::get('/absent-list', [AttendanceController::class, 'absentList'])->name('absent-list');
        Route::get('/absent-list-pagination', [AttendanceController::class, 'absentListPagination'])->name('absent-list-pagination');



        //Permission List
        Route::get('/permission-list', [AttendanceController::class, 'permissionList'])->name('permission-list');
        Route::get('/permission-list-pagination', [AttendanceController::class, 'permissionListPagination'])->name('permission-list-pagination');



        //Task List
        Route::get('/task-list', [TaskController::class, 'taskList'])->name('employee-task-list');
        Route::get('/task-details/{taskList}', [TaskController::class, 'taskDetails'])->name('task-details');
        Route::get('/task-list-pagination', [TaskController::class, 'taskListPagination'])->name('task-list-pagination');

        //Language List
        Route::get('/language-list', [LanguageController::class, 'languageList'])->name('language-list');
        Route::get('/language-add', [LanguageController::class, 'addLanguageForm'])->name('add-language');
        Route::post('/language-add-process', [LanguageController::class, 'addLanguageProcess'])->name('add-language-process');
        Route::get('/language-edit/{id}', [LanguageController::class, 'editLanguage'])->name('language-edit');
        Route::post('/language-update', [LanguageController::class, 'updateLanguage'])->name('language-update');
        Route::post('/language-delete', [LanguageController::class, 'deleteLanguage'])->name('language-delete');
        Route::get('/language-list-pagination', [LanguageController::class, 'languageListPagination'])->name('language-list-pagination');




});
