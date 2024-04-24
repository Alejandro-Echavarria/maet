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
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
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
                'technologies:id,name',
                'client' => function ($query) {
                    $query->select('clients.id', 'clients.first_name', 'clients.last_name', 'images.url')
                        ->from('clients')
                        ->leftJoin('images', function (JoinClause $join) {
                            $join->on('images.imageable_id', '=', 'clients.id')
                                ->where('images.imageable_type', '=', Client::class)
                                ->where('images.default', '=', '1');
                        });
                },
                'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc');
                }
            ]
        )
            ->filter($filter)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        $clients = Client::selectRaw("
            clients.id,
            CONCAT(clients.first_name, ' ', clients.last_name, ' - [', (CASE WHEN clients.status = 1 THEN 'Active' ELSE 'Inactive' END), ']') as name
        ")
            ->get();

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
                'client_id'        => "required|exists:clients,id,status,1",
                'title'            => "required|max:255|unique:jobs,title",
                'slug'             => "required|unique:jobs",
                'color'            => "required|max:255|string",
                'file'             => "required|image",
                'project_name'     => "required|max:140|string",
                'link'             => "string|max:255|url:https",
                'preview'          => "required|string",
                'body'             => "required|string",
                'alt_banner_image' => "string|max:255|nullable",
                'is_published'           => "required|boolean",
            ],
            [
                // Custom error messages
            ],
            [
                // Custom attribute names
                'file' => 'image',
                'client_id'   => 'client',
                'category_id' => 'category',
            ]
        );

        $technologies = $request->validate([
            'technologies'   => 'required|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        DB::beginTransaction();
        try {
            $job = Job::create($data);

            $job->technologies()->attach($technologies['technologies']);

            if ($request->file('file')) {
                ImageController::store($request->file('file'), $job, $this->directory);
            }

            // Store images from ckeditor
            ImageController::ckeditorStore($job, $job['preview'], $this->directoryCkeditor, "/preview");
            ImageController::ckeditorStore($job, $job['body'], $this->directoryCkeditor, "/body");
        } catch (\Exception $e) {
            DB::rollback();

            return to_route('admin.jobs.index')->withErrors(['create' => $e->getMessage()]);
        }
        DB::commit();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.jobs.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Job Created');
    }

    public function ckeditorMoveToStorage(Request $request)
    {
        $request->validate([
            'upload' => "required|image"
        ]);

        $url = ImageController::ckeditorMoveToStorage($request->file('upload'), $this->directoryCkeditor . $request['addPath']);

        return $url;
    }

    public function update(Request $request, Job $job)
    {
        $validClientStatus = Job::selectRaw(
            "
                jobs.client_id AS job_client_id,
                clients.id AS client_id,
                clients.status,
                (
                    CASE WHEN $request->client_id = clients.id THEN 1 ELSE 0 END
                ) AS client_valid
            "
        )
            ->join('clients', 'clients.id', '=', 'jobs.client_id')
            ->where('jobs.id', $job->id)
            ->first();

        $request['slug'] = Str::slug($request->title);
        $data = $request->validate(
            [
                'category_id'      => "required|exists:categories,id",
                'client_id'        => "required|exists:clients,id" . ($validClientStatus->client_valid ? '' : ',status,1'),
                'title'            => "required|max:255|unique:jobs,title,$job->id",
                'slug'             => "required|unique:jobs,slug,$job->id",
                'color'            => "required|max:255|string",
                'file'             => $request->file('file') ? "required|image" : "required|string",
                'project_name'     => "required|max:140|string",
                'link'             => "string|max:255|url:https",
                'preview'          => "required|string",
                'body'             => "required|string",
                'price'            => "required|numeric|min:0",
                'alt_banner_image' => "string|max:255|nullable",
                'is_published'     => "required|boolean",
            ],
            [
                // Custom error messages
            ],
            [
                // Custom attribute names
                'file'        => 'image',
                'client_id'   => 'client',
                'category_id' => 'category',
            ]
        );

        $technologies = $request->validate([
            'technologies'   => 'required|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        DB::beginTransaction();
        try {
            $job->update($data);

            $job->technologies()->sync($technologies['technologies']);

            if ($request->file('file')) {
                ImageController::store($request->file('file'), $job, $this->directory);
            }

            // Store images from ckeditor
            ImageController::ckeditorUpdate($job, $job['preview'], $this->directoryCkeditor, "/preview");
            ImageController::ckeditorUpdate($job, $job['body'], $this->directoryCkeditor, "/body");
        } catch (\Exception $e) {
            DB::rollback();

            return to_route('admin.jobs.index')->withErrors(['update' => $e->getMessage()]);
        }
        DB::commit();

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
