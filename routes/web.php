<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'] )->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/parent-dashboard', [\App\Http\Controllers\Parent\ParentController::class, 'index'] )->middleware(['auth', 'verified'])->name('parent.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/students', [\App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
    Route::get('/admin/students/create', [\App\Http\Controllers\StudentController::class, 'create']);
    Route::post('/admin/students/store', [\App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
    Route::get('/admin/students/{student}/edit', [\App\Http\Controllers\StudentController::class, 'edit']);
    Route::post('/admin/students/{student}/update', [\App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
    Route::post('/admin/students/{student}/delete', [\App\Http\Controllers\StudentController::class, 'destroy'])->name('student.destroy');


    Route::get('/admin/parents', [\App\Http\Controllers\ParentController::class, 'index'])->name('parents.index');
    Route::get('/admin/parents/create', [\App\Http\Controllers\ParentController::class, 'create']);
    Route::post('/admin/parents/store', [\App\Http\Controllers\ParentController::class, 'store'])->name('parents.store');
    Route::get('/admin/parents/{parent}/edit', [\App\Http\Controllers\ParentController::class, 'edit']);
    Route::post('/admin/parents/{parent}/update', [\App\Http\Controllers\ParentController::class, 'update'])->name('parents.update');
    Route::post('/admin/parents/{parent}/delete', [\App\Http\Controllers\ParentController::class, 'destroy'])->name('parents.destroy');

    Route::get('/admin/settings', [\App\Http\Controllers\SchoolSettingController::class, 'index'])->name('settings.index');
    Route::get('/admin/settings/create-session', [\App\Http\Controllers\SchoolSettingController::class, 'createSettings']);
    Route::post('/admin/settings/store-session', [\App\Http\Controllers\SchoolSettingController::class, 'storeSettings'])->name('settings.store');
    Route::get('/admin/settings/{session}/edit-session', [\App\Http\Controllers\SchoolSettingController::class, 'editSettings']);
    Route::post('/admin/settings/{session}/update-session', [\App\Http\Controllers\SchoolSettingController::class, 'updateSettings'])->name('settings.update');
    Route::post('/admin/settings/{session}/delete-session', [\App\Http\Controllers\SchoolSettingController::class, 'deleteSettings'])->name('settings.destroy');

    Route::get('/admin/classes', [\App\Http\Controllers\ClassesController::class, 'index'])->name('classes.index');
    Route::get('/admin/classes/create', [\App\Http\Controllers\ClassesController::class, 'create']);
    Route::post('/admin/classes/store', [\App\Http\Controllers\ClassesController::class, 'store'])->name('classes.store');
    Route::get('/admin/classes/{class}/edit', [\App\Http\Controllers\ClassesController::class, 'edit'])->name('classes.edit');
    Route::post('/admin/classes/{class}/update', [\App\Http\Controllers\ClassesController::class, 'update'])->name('classes.update');
    Route::post('/admin/classes/destroy', [\App\Http\Controllers\ClassesController::class, 'destroy'])->name('classes.destroy');


    Route::get('/admin/attendance', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/admin/attendance/create', [\App\Http\Controllers\AttendanceController::class, 'create']);
    Route::post('/admin/attendance/store', [\App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/admin/attendance/{attendance}/destroy', [\App\Http\Controllers\AttendanceController::class, 'destroy'])->name('attendance.destroy');

    Route::get('/admin/school-fees', [\App\Http\Controllers\SchoolFeeController::class, 'index'])->name('plan.index');
    Route::get('/admin/school-fees/create', [\App\Http\Controllers\SchoolFeeController::class, 'create']);
    Route::post('/admin/school-fees/store', [\App\Http\Controllers\SchoolFeeController::class, 'store'])->name('plan.store');
    Route::get('/admin/school-fees/{payment_plan}/edit', [\App\Http\Controllers\SchoolFeeController::class, 'edit'])->name('plan.edit');
    Route::post('/admin/school-fees/{plan_plan}/update', [\App\Http\Controllers\SchoolFeeController::class, 'update'])->name('plan.update');
    Route::post('/admin/school-fees/{payment_plan}/destroy', [\App\Http\Controllers\SchoolFeeController::class, 'destroy'])->name('plan.destroy');

});

require __DIR__.'/auth.php';
