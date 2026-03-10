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

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/netflix-accounts', NetflixAccountsController::class);
        Route::resource('/netflix-week-accounts', NetflixWeekAccountController::class);

        Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');

        Route::get('/netflix-accounts-export', [NetflixAccountsController::class, 'export'])->name('netflix-accounts.export');
        Route::get('/netflix-week-accounts-export', [NetflixWeekAccountController::class, 'export'])->name('netflix-week-accounts.export');

        Route::post('/netflix-accounts-import', [NetflixAccountsController::class, 'import'])->name('netflix-accounts.import');
        Route::post('/netflix-week-accounts-import', [NetflixWeekAccountController::class, 'import'])->name('netflix-week-accounts.import');

        Route::get('/netflix-accounts-template', [NetflixAccountsController::class, 'downloadTemplate'])->name('netflix-accounts.template');
        Route::get('/netflix-week-accounts-template', [NetflixWeekAccountController::class, 'downloadTemplate'])->name('netflix-week-accounts.template');
    });
