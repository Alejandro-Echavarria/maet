<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ImageController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Client;
use App\Models\Job;
use App\Models\Technology;
use Illuminate\Support\Str;

class JobController extends Controller
{
    protected $directory;
    protected $directoryCkeditor;

    public function __construct()
    {
        $this->directory = 'images/jobs';
        $this->directoryCkeditor = 'images/ckeditor/jobs';
    }

    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $jobs = Job::with(
            [
                'technologies:id,name', 'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc');
                }
            ]
        )
            ->filter($filter)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        $clients = Client::selectRaw("id, CONCAT(first_name, ' ', last_name) as name")->get();
        $categories = Category::all();
        $technologies = Technology::all();

        return Inertia::render('Admin/Jobs/Index', compact('page', 'filter', 'jobs', 'clients', 'categories', 'technologies'));
    }

    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->title);
        $data = $request->validate(
            [
                'category_id'      => "required|exists:categories,id",
                'client_id'        => "required|exists:clients,id",
                'title'            => "required|max:255|unique:jobs,title",
                'slug'             => "required|unique:jobs",
                'color'            => "required|max:255|string",
                'file'             => "required|image",
                'project_name'     => "required|max:140|string",
                'link'             => "string|max:255|url:https",
                'preview'          => "required|string",
                'body'             => "required|string",
                'alt_banner_image' => "string|max:255|nullable",
                'status'           => "required|boolean",
            ],
            [
                // Custom error messages
            ],
            [
                // Custom attribute names
                'file' => 'image',
            ]
        );

        $technologies = $request->validate([
            'technologies'   => 'required|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $job = Job::create($data);

        $job->technologies()->attach($technologies['technologies']);

        if ($request->file('file')) {
            ImageController::store($request->file('file'), $job, $this->directory);
        }

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.jobs.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Job Created');
    }

    public function ckeditorStore(Request $request)
    {
        $request->validate([
            'upload' => "required|image"
        ]);

        $data = Job::where('slug', $request->id)->first();

        $url = ImageController::ckeditorStore($request->file('upload'), $data, $this->directoryCkeditor . $request['addPath']);

        return $url;
    }

    public function update(Request $request, Job $job)
    {
        $request['slug'] = Str::slug($request->title);
        $data = $request->validate(
            [
                'category_id'      => "required|exists:categories,id",
                'client_id'        => "required|exists:clients,id",
                'title'            => "required|max:255|unique:jobs,title,$job->id",
                'slug'             => "required|unique:jobs,slug,$job->id",
                'color'            => "required|max:255|string",
                'file'             => $request->file('file') ? "required|image" : "required|string",
                'project_name'     => "required|max:140|string",
                'link'             => "string|max:255|url:https",
                'preview'          => "required|string",
                'body'             => "required|string",
                'alt_banner_image' => "string|max:255|nullable",
                'status'           => "required|boolean",
            ],
            [
                // Custom error messages
            ],
            [
                // Custom attribute names
                'file' => 'image',
            ]
        );

        $technologies = $request->validate([
            'technologies'   => 'required|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $job->update($data);

        $job->technologies()->sync($technologies['technologies']);

        if ($request->file('file')) {
            ImageController::store($request->file('file'), $job, $this->directory);
        }

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
        ImageController::destroy($job);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.jobs.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Job Deleted');
    }
}
