<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\UserSocialMediaController;
use App\Http\Controllers\Admin\AboutMeController;

Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');

Route::resource('user-social-medias', UserSocialMediaController::class)->names('admin.usersocialmedias');

Route::get('about-me', [AboutMeController::class, 'index'])->name('admin.aboutme.index');
Route::put('about-me/{user}', [AboutMeController::class, 'update'])->name('admin.aboutme.update');

Route::resource('social-medias', SocialMediaController::class)->names('admin.socialmedias');