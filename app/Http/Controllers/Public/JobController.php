<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Image;
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
        $job = $job->with(['technologies:id,name'])
            ->where('id', $job->id)
            ->first();

        $job['images'] = Image::where('imageable_id', $job->id)
            ->where('default', '=', '1')
            ->take(1)
            ->get();

        return Inertia::render('Public/Jobs/Show', compact('job'));
    }
}
