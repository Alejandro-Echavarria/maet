<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class JobController extends Controller
{

    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->filter_value;
        $filterModel = $request?->filter;

        $jobs = Job::with(
            [
                'technologies:id,name,icon',
                'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc');
                },
            ]
        )
            ->filter($filter, $filterModel)
            ->where('jobs.status', '=', '1')
            ->paginate(4);

        $categories = Category::select('categories.*')->join(
            'jobs', 'jobs.category_id', '=','categories.id'
        )->distinct()->get();

        return Inertia::render('Public/Jobs/Index', compact('page', 'filterModel', 'filter', 'jobs', 'categories'));
    }

    public function show(Job $job)
    {
        $this->authorize('published', $job);

        $job = $job->with(
            [
                'technologies:id,name',
                'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc');
                },

            ]
        )
            ->where('id', $job->id)
            ->where('status', '=', '1')
            ->first();

        return Inertia::render('Public/Jobs/Show', compact('job'));
    }
}
