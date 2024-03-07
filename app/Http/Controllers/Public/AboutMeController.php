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
            ->with(['experiences', 'knowledge' => function ($query) {
                $query->select('user_id', 'name', 'icon')
                    ->where('main', '=', '1');
            }])
            ->first();

        return Inertia::render('Public/AboutMe/Index', compact('user'));
    }
}
