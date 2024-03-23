<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::select(['id', 'name', 'email', 'position', 'bio'])
            ->with(['experiences', 'knowledge' => function ($query) {
                $query->select('user_id', 'name', 'icon')
                    ->where('main', '=', '1');
            }])
            ->first();

        $jobs = Job::with(['technologies:id,name,icon', 'images' => function ($query) {
            $query->select('id', 'url', 'default', 'imageable_id')
                ->where('default', '=', '1')
                ->orderBy('id', 'desc');
        }])
            ->where('status', 1)
            ->limit(4)
            ->get();

        return Inertia::render('Welcome', compact('user', 'jobs'));
    }
}
