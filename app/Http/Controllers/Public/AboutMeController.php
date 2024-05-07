<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class AboutMeController extends Controller
{
    public function index()
    {
        $user = User::select(['id', 'name', 'email', 'position', 'bio'])
            ->with(
                [
                    'experiences' => function ($query) {
                        $query->select('user_id', 'title', 'description', 'start_date', 'end_date', 'is_current', 'color')->orderBy('start_date', 'desc');
                    },
                    'education',
                    'knowledge' => function ($query) {
                        $query->select('user_id', 'name', 'icon');
                    },
                    'platforms' => function ($query) {
                        $query->select('platforms.platform_type_id', 'platforms.url', 'platforms.platformable_id')
                            ->with('platformType:id,name,icon');
                    },
                ]
            )
            ->first();

        return Inertia::render('Public/AboutMe/Index', compact('user'));
    }
}
