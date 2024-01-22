<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Client;
use App\Models\Job;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $jobs = Job::with(['technologies:id,name', 'image'])
            ->filter($filter)
            ->orderBy('created_at', 'desc')
            ->paginate(11);
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

        if ($request->file('file')) {
            $file = new ImageController;

            $file = $file->store($request->file('file'), $job);
        }

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.jobs.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Job Created');
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

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.jobs.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Job Updated');
    }

    public function destroy(Request $request, Job $job)
    {
        $job->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.jobs.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Job Deleted');
    }
}
