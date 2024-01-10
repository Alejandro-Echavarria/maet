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
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $jobs = Job::with(['technologies:id,name'])
            ->filter($filter)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $clients = Client::all();
        $categories = Category::all();
        $technologies = Technology::all();

        return Inertia::render('Admin/Jobs/Index', compact('page', 'filter', 'jobs', 'clients', 'categories', 'technologies'));
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
            'technologies'   => 'required|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $job = Job::create($data);

        $job->technologies()->attach($technologies['technologies']);

        return to_route('admin.jobs.index');
    }

    public function update(Request $request, Job $job)
    {
        $data = $request->validate([
            'category_id'    => "required|exists:categories,id",
            'client_id'      => "required|exists:clients,id",
            'title'          => "required|max:255|unique:jobs,title,$job->id",
            'color'          => "required|max:255|string",
            'project_name'   => "required|max:255|string",
            'preview'        => "required|string",
            'body'           => "required|string",
        ]);

        $technologies = $request->validate([
            'technologies'   => 'required|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $job->update($data);

        $job->technologies()->sync($technologies['technologies']);

        return to_route('admin.jobs.index');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return to_route('admin.jobs.index');
    }
}
