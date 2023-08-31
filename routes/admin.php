<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\UserSocialMediaController;

Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');

Route::resource('user-social-medias', UserSocialMediaController::class)->names('admin.usersocialmedias');

Route::resource('social-medias', SocialMediaController::class)->names('admin.socialmedias');