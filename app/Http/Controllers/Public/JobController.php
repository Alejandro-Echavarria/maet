<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    public function show(Job $job)
    {
        $job = $job->with(['technologies:id,name', 'images' => function ($query) {
            $query->select('id', 'url', 'default', 'imageable_id')
                ->where('default', '=', '1')
                ->orderBy('id', 'desc');
        }])
            ->first();

        return Inertia::render('Public/Jobs/Show', compact('job'));
    }
}
