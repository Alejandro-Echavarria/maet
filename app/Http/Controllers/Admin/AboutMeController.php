<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Models\UserSocialMedia;
use Inertia\Inertia;

class AboutMeController extends Controller
{
    public function index()
    {
        $userSocialMedias = UserSocialMedia::orderBy('created_at', 'desc')
            ->paginate(10);

        $socialMedias = SocialMedia::get(['id', 'name']);

        return Inertia::render('Admin/AboutMe/Index', compact('userSocialMedias', 'socialMedias'));
    }
}
