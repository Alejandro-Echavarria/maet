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
            ->with(
                [
                    'experiences' => function ($query) {
                        $query->select('user_id', 'title', 'description', 'start_date', 'end_date', 'is_current')
                            ->orderBy('start_date', 'desc');
                    },
                    'knowledge' => function ($query) {
                        $query->select('user_id', 'name', 'icon')
                            ->where('main', '=', '1');
                    }
                ]
            )
            ->first();

        $jobs = Job::select('id', 'category_id', 'title', 'slug', 'preview', 'project_name', 'alt_banner_image', 'link', 'status', 'created_at', 'updated_at')->with(
            [
                'category:id,name,slug',
                'technologies:id,name,icon', 'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc');
                }
            ]
        )
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return Inertia::render('Welcome', compact('user', 'jobs'));
    }
}
