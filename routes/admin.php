<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\UserSocialMediaController;
use App\Http\Controllers\Admin\AboutMeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\KnowleedgeController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Jobs
Route::resource('jobs', JobController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.jobs');
Route::post('ckeditor/images/job/store', [JobController::class, 'ckeditorStore'])->name('admin.ckeditor.images.job.store');

// Social medias for user
Route::resource('user-social-medias', UserSocialMediaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.usersocialmedias');

// Services
Route::resource('services', ServiceController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.services');

// About Me
Route::get('about-me', [AboutMeController::class, 'index'])->name('admin.aboutme.index');
Route::put('about-me/{user}', [AboutMeController::class, 'update'])->name('admin.aboutme.update');
Route::post('ckeditor/images/about-me//store', [AboutMeController::class, 'ckeditorStore'])->name('admin.ckeditor.images.aboutme.store');

// Social medias
Route::resource('social-medias', SocialMediaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.socialmedias');

// Categories
Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.categories');

// Technologies
Route::resource('technologies', TechnologyController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.technologies');

// Educations
Route::resource('resume/educations', EducationController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.resume.educations');

// Experiences
Route::resource('resume/experiences', ExperienceController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.resume.experiences');

// Knowledges
Route::resource('resume/knowledge', KnowleedgeController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.resume.knowledge');
