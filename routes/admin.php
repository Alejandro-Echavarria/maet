<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;

Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/jobs', [JobController::class, 'index'])->name('admin.jobs.index');