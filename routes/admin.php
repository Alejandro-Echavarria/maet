<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\UserSocialMediaController;
use App\Http\Controllers\Admin\AboutMeController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EducationController;

Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');

// Social medias for user
Route::resource('user-social-medias', UserSocialMediaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.usersocialmedias');

// Services
Route::resource('services', ServiceController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.services');

// About Me
Route::get('about-me', [AboutMeController::class, 'index'])->name('admin.aboutme.index');
Route::put('about-me/{user}', [AboutMeController::class, 'update'])->name('admin.aboutme.update');

// Social medias
Route::resource('social-medias', SocialMediaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.socialmedias');

// Educations
Route::resource('resume/educations', EducationController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.resume.educations');

// Experiences
Route::resource('resume/experiences', ExperienceController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.resume.experiences');
