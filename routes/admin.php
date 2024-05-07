<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutMeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\KnowleedgeController;
use App\Http\Controllers\Admin\PlatformController;
use App\Http\Controllers\Admin\PlatformTypeController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Jobs
Route::resource('jobs', JobController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.jobs');
Route::post('ckeditor/images/job/store', [JobController::class, 'ckeditorMoveToStorage'])->name('admin.ckeditor.images.job.movetostorage');

// Platforms
Route::resource('platforms', PlatformController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.platforms');

// Services
Route::resource('services', ServiceController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.services');

// Clients
Route::resource('clients', ClientController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.clients');
Route::get('client-jobs/{client}', [ClientController::class, 'clientJobs'])->name('admin.clients.clientjobs');

// About Me
Route::get('about-me', [AboutMeController::class, 'index'])->name('admin.aboutme.index');
Route::put('about-me/{user}', [AboutMeController::class, 'update'])->name('admin.aboutme.update');
Route::post('ckeditor/images/about-me/store', [AboutMeController::class, 'ckeditorMoveToStorage'])->name('admin.ckeditor.images.aboutme.movetostorage');

// Platform types
Route::resource('platform-types', PlatformTypeController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.platformtypes');

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

// Show private images for clients
Route::get('images/clients/{image}', [ImageController::class, 'show'])->name('admin.clients.showImage');

// Company settings
Route::resource('companies', CompanyController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.companies');
