<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Technology;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::select(['name', 'email', 'position', 'bio'])->first();

        $technologies = Technology::select(['id', 'name', 'icon'])->where('main', '=', '1')->get();

        $jobs = Job::with(['technologies:id,name,icon', 'images' => function ($query) {
            $query->select('id', 'url', 'default', 'imageable_id')
                ->where('default', '=', '1')
                ->orderBy('id', 'desc');
        }])
            ->where('status', 1)
            ->get();

        return Inertia::render('Welcome', compact('user', 'technologies', 'jobs'));
    }
}
