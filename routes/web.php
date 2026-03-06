<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NetflixAccountsController;
use App\Http\Controllers\NetflixWeekAccountController;
use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/netflix-accounts', NetflixAccountsController::class);
    Route::resource('/netflix-week-accounts', NetflixWeekAccountController::class);

    Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
});