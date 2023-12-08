<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Client;
use App\Models\Job;
use App\Models\Technology;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        $clients = Client::all();
        $categories = Category::all();
        $technologies = Technology::all();

        return Inertia::render('Admin/Jobs/Index', compact('jobs', 'clients', 'categories', 'technologies'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'    => "required|exists:categories,id",
            'client_id'      => "required|exists:clients,id",
            'title'          => "required|max:255|unique:jobs,title",
            'color'          => "required|max:255|string",
            'project_name'   => "required|max:255|string",
            'preview'        => "required|string",
            'body'           => "required|string",
        ]);

        $technologies = $request->validate([
            'technologies' => 'required|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $job = Job::create($data);

        $job->technologies()->attach($technologies['technologies']);

        return to_route('admin.jobs.index');
    }
}
