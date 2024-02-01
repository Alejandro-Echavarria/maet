<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::select(['name', 'email', 'position'])->first();
        $jobs = Job::with(['technologies:id,name', 'images' => function ($query) {
            $query->select('id', 'url', 'default', 'imageable_id')
                ->where('default', '=', '1')
                ->orderBy('id', 'desc');
        }])
            ->where('status', 1)
            ->get();

        return Inertia::render('Welcome', compact('user', 'jobs'));
    }
}
