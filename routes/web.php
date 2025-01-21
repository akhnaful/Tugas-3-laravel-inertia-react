<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
// use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),  
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
// Route admin
// Route::middleware(['auth','role:admin'])->group(function () { 
//     Route::res('/manage/users', [AdminController::class, 'manageUsers'])->name('manage.users'); 
//     Route::get('/manage/posts', [AdminController::class, 'managePosts'])->name('manage.posts'); 
//     Route::get('/manage/user-violations', [AdminController::class, 'manageUserViolations'])->name('manage.user.violations'); 
//     Route::get('/community/statistics', [AdminController::class, 'communityStatistics'])->name('community.statistics'); });

require __DIR__.'/auth.php';
