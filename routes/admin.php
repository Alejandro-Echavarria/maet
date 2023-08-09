<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\AboutMeController;
use App\Http\Controllers\Admin\SocialMediaController;

Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');

Route::resource('aboutme', AboutMeController::class)->names('admin.aboutme');

Route::resource('socialmedias', SocialMediaController::class)->names('admin.socialmedias');