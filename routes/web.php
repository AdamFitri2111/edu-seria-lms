<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Courses - index (semua user)
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

    // Educator only
    Route::middleware(['role:educator'])->group(function () {
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
        Route::resource('/users', UserController::class)->except(['show']);
    });

    // Course show — MESTI lepas /courses/create
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

    // Learner only
    Route::middleware(['role:learner'])->group(function () {
        Route::post('/enroll/{course}', [EnrollmentController::class, 'store'])->name('enroll.store');
        Route::delete('/enroll/{course}', [EnrollmentController::class, 'destroy'])->name('enroll.destroy');
        Route::get('/my-courses', [EnrollmentController::class, 'index'])->name('my.courses');
    });

});