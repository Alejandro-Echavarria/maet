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
        $page = $request?->page;
        $filter = $request?->search;

        $userSocialMedias = UserSocialMedia::with('socialMedia:id,name')
            ->filter($filter)
            ->orderBy('social_media_user.created_at', 'desc')
            ->paginate(10);

        $socialMedias = SocialMedia::get(['id', 'name']);

        return Inertia::render('Admin/UserSocialMedias/Index', compact('userSocialMedias', 'socialMedias', 'page', 'filter'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'social_media_id' => "required|exists:social_medias,id|unique:social_media_user,social_media_id,$request->id",
            'url' => 'required|max:255|string|url',
        ]);

        $data['user_id'] = auth()->user()->id;

        UserSocialMedia::create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.usersocialmedias.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'User social Media Updated');
    }

    public function update(Request $request, UserSocialMedia $userSocialMedia)
    {
        $userSocialMedia->update(
            $request->validate([
                'social_media_id' => "required|exists:social_medias,id|unique:social_media_user,social_media_id,$userSocialMedia->id",
                'url' => 'required|max:255|string|url',
            ])
        );

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.usersocialmedias.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'User social Media Updated');
    }

    public function destroy(Request $request, UserSocialMedia $userSocialMedia)
    {
        $userSocialMedia->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.usersocialmedias.index', [
            'search' => $search,
            'page' => $page
        ]);
    }
}
