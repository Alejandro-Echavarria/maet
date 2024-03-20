<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Inertia\Inertia;

class JobController extends Controller
{

    public function index()
    {
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
            ->where('jobs.status', '=', '1')
            ->paginate(11);

        return Inertia::render('Public/Jobs/Index', compact('jobs'));
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
