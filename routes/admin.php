<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\AboutMeController;
use App\Http\Controllers\Admin\SocialMediaController;

Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');

Route::get('aboutme', [AboutMeController::class, 'index'])->name('admin.aboutme.index');
Route::post('aboutme/store', [AboutMeController::class, 'store'])->name('admin.aboutme.store');

Route::resource('socialmedias', SocialMediaController::class)->names('admin.socialmedias');