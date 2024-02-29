<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\ContactUsController;
use App\Http\Controllers\Public\JobController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Jobs
Route::get('jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Mails
Route::post('contact-us', [ContactUsController::class, 'store'])->name('contactus.store');
