<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\UserSocialMediaController;
use App\Http\Controllers\Admin\AboutMeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ResumeController;

Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');

// Social medias for user
Route::resource('user-social-medias', UserSocialMediaController::class)->names('admin.usersocialmedias');

// Services
Route::resource('services', ServiceController::class)->names('admin.services');

// About Me
Route::get('about-me', [AboutMeController::class, 'index'])->name('admin.aboutme.index');
Route::put('about-me/{user}', [AboutMeController::class, 'update'])->name('admin.aboutme.update');

// Social medias
Route::resource('social-medias', SocialMediaController::class)->names('admin.socialmedias');

// Educations
Route::get('resume', [ResumeController::class, 'index'])->name('admin.resume.index');
Route::post('resume', [ResumeController::class, 'storeEducation'])->name('admin.resume.education.store');
Route::put('resume/{education}', [ResumeController::class, 'updateEducation'])->name('admin.resume.education.update');