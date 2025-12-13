<?php

use App\Http\Controllers\academic\annual\AnnualController;
use App\Http\Controllers\academic\assignCurriculam\AssignCurriculamController;
use App\Http\Controllers\academic\branch\BranchController;
use App\Http\Controllers\academic\course\CourseController;
use App\Http\Controllers\academic\institute\InstituteController;
use App\Http\Controllers\academic\scheme\SchemeController;
use App\Http\Controllers\academic\semester\SemesterController;
use App\Http\Controllers\academic\session\SessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionCategoryController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admindashboard.get');
});

Route::middleware(['auth'])->prefix('backend')->group(function () {
    // Route::get('/', function () {
    //     return view('backend.index');
    // });
    // Route::get('/', [AdminController::class, 'index'])->name('admindashboard.get');

    Route::get('/roles', [PermissionController::class, 'roles'])->name('roles');
    Route::post('/roles/store', [PermissionController::class, 'roles_store'])->name('roles.store');
    Route::get('/roles/{roles_id}/edit', [PermissionController::class, 'edit_roles'])->name('roles.edit');
    Route::post('/roles/{roles_id}/update', [PermissionController::class, 'update_roles'])->name('roles.update');
    Route::get('/roles/{roles_id}/destroy', [PermissionController::class, 'destroy_roles'])->name('roles.destroy');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee/store', [EmployeeController::class, 'employee_store'])->name('employee.store');
    Route::get('/employee/{employee_id}/edit', [EmployeeController::class, 'edit_employee'])->name('employee.edit');
    Route::post('/employee/{employee_id}/update', [EmployeeController::class, 'update_employee'])->name('employee.update');
    Route::get('/employee/{employee_id}/destroy', [EmployeeController::class, 'destroy_employee'])->name('employee.destroy');

    // Session Routes
    Route::resource('/sessions', SessionController::class);

    // Course Routes
    Route::resource('/courses', CourseController::class);

    // Institute Routes
    Route::resource('/institutes', InstituteController::class);
    
    //Scheme Routes
    Route::resource('/schemes', SchemeController::class);

    // Branch Routes
    Route::resource('/branches', BranchController::class);

    //Semester Routes
    Route::resource('/semesters', SemesterController::class);

    //Annual Routes
    Route::resource('/annuals', AnnualController::class);

    //Assign Curriculam Routes
    Route::resource('/assign-curriculams', AssignCurriculamController::class);
    Route::get('/assign-curriculam/get-branches/{course_id}', [AssignCurriculamController::class, 'getBranches'])->name('assign-curriculam.getBranches');
    


    Route::get('/permission', [PermissionController::class, 'permission'])->name('permission');
    Route::post('/permission/store', [PermissionController::class, 'permission_store'])->name('permission.store');

    Route::resource('/permission-categories',PermissionCategoryController::class);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.backend');

});

// Route::get('/backend/login', function () {
//     return view('backend.login');
// });
Route::get('backend/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('backend/login', [AuthController::class, 'login'])->name('adminlogin.post');
