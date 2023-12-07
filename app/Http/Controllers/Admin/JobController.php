<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Client;
use App\Models\Job;
use App\Models\Language;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        $clients = Client::all();
        $categories = Category::all();
        $languages = Language::all();

        return Inertia::render('Admin/Jobs/Index', compact('jobs', 'clients', 'categories', 'languages'));
    }
}
