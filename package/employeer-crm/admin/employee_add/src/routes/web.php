<?php

use Illuminate\Support\Facades\Route;


use Employeecrm\Admin\App\Http\Controllers\EmployeeController;








Route::get('/employee-form', [EmployeeController::class, 'employeeForm'])->name('employee-form');
Route::post('/employee-add', [EmployeeController::class, 'employeeAdd'])->name('employee-add');
Route::get('/employee-list', [EmployeeController::class, 'employeeList'])->name('employee-list');
Route::get('/employee-responce', [EmployeeController::class, 'employeeResponseData'])->name('employee-responce');
Route::get('/employee-details/{id}', [EmployeeController::class, 'employeeDetails'])->name('employee-details');
Route::get('/employee-edit/{id}', [EmployeeController::class, 'employeeEdit'])->name('employee-edit');
Route::post('/employee-update', [EmployeeController::class, 'employeeUpdate'])->name('employee-update');
Route::post('/employee-delete', [EmployeeController::class, 'employeeDelete'])->name('employee-delete');


Route::get('/file-upload', [EmployeeController::class, 'fileUpload'])->name('file-upload');
Route::post('/employee-list-import', [EmployeeController::class, 'employeeListImport'])->name('employee-list-import');
Route::get('/employee-list-export', [EmployeeController::class, 'employeeListExport'])->name('employee-list-export');


















?>
