<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $companyType = Company::select('company_type_id')->orderBy('id', 'asc')->first()->company_type_id;

        $user = User::select(['id', 'name', 'email', 'position', 'bio'])
            ->with(
                [
                    'experiences' => function ($query) {
                        $query->select('user_id', 'title', 'description', 'start_date', 'end_date', 'is_current')
                            ->orderBy('start_date', 'desc');
                    },
                    'knowledge' => function ($query) {
                        $query->select('user_id', 'name', 'icon')
                            ->where('is_main', '=', '1');
                    }
                ]
            )
            ->first();

        $jobs = Job::select('id', 'category_id', 'title', 'slug', 'preview', 'project_name', 'alt_banner_image', 'link', 'is_published', 'created_at', 'updated_at')->with(
            [
                'category:id,name,slug',
                'technologies:id,name,icon',
                'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc')
                        ->limit(1);
                }
            ]
        )
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $view = $companyType === 1 ? 'Welcome' : 'Public/Home/HomeCompany';

        return Inertia::render($view, compact('user', 'jobs'));
    }
}
