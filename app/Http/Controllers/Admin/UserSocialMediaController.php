<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Models\UserSocialMedia;
use Inertia\Inertia;

class UserSocialMediaController extends Controller
{
    public function index(Request $request)
    {
        $userSocialMedias = UserSocialMedia::orderBy('created_at', 'desc')
            ->paginate(10);

        $socialMedias = SocialMedia::get(['id', 'name']);

        return Inertia::render('Admin/UserSocialMedias/Index', compact('userSocialMedias', 'socialMedias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'social_media_id' => "required|exists:social_medias,id|unique:social_media_user,social_media_id,$request->id",
            'url' => 'required|max:255|string|url',
        ]);

        $data['user_id'] = auth()->user()->id;

        UserSocialMedia::create($data);

        return to_route('admin.usersocialmedias.index');
    }
}
