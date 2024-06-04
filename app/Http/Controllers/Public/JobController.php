<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\Technology;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{

    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->category;
        $filterTechnology = $request?->technology;

        $jobs = Job::select('id', 'category_id', 'title', 'slug', 'preview', 'project_name', 'alt_banner_image', 'link', 'is_published', 'created_at', 'updated_at')->with(
            [
                'category:id,name',
                'technologies:id,name,icon',
                'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc')
                        ->limit(1);
                }
            ]
        )
            ->filter($filter, $model = 'category')
            ->filter($filterTechnology, $model = 'technology')
            ->where('jobs.is_published', '=', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $categories = Category::select('categories.name', 'categories.slug')
            ->join('jobs', 'jobs.category_id', '=', 'categories.id')
            ->where('jobs.is_published', '=', '1')
            ->groupBy('categories.id')
            ->get();

        $technologies = Technology::select('technologies.name', 'technologies.slug')
            ->join('job_technology', 'job_technology.technology_id', '=', 'technologies.id')
            ->join('jobs', 'jobs.id', '=', 'job_technology.job_id')
            ->where('jobs.is_published', '=', '1')
            ->groupBy('technologies.id')
            ->get();

        return Inertia::render('Public/Jobs/Index', compact('jobs', 'categories', 'technologies'));
    }

    public function show(Job $job)
    {
        $this->authorize('published', $job);

        $job = $job->select('id', 'category_id', 'title', 'slug', 'color', 'project_name', 'alt_banner_image', 'preview', 'body', 'link', 'is_published', 'created_at', 'updated_at')->with(
            [
                'category:id,name,slug',
                'technologies:id,name,slug,icon',
                'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc')
                        ->limit(1);
                },

            ]
        )
            ->where('id', $job->id)
            ->first();

        return Inertia::render('Public/Jobs/Show', compact('job'));
    }
}
