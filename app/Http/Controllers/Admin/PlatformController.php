<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\PlatformType;
use App\Models\SocialMedia;
use App\Models\UserSocialMedia;
use Inertia\Inertia;

class PlatformController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $platforms = Platform::with('platformType:id,name,icon')
            ->filter($filter)
            ->orderBy('platforms.created_at', 'desc')
            ->paginate(10);

        $platformTypes = PlatformType::get(['id', 'name']);

        return Inertia::render('Admin/Platforms/Index', compact('platforms', 'platformTypes', 'page', 'filter'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform_type_id' => "required|exists:platform_types,id|unique:platforms,id,$request->id",
            'url'              => 'required|max:255|string|url:https',
        ]);

        // $data['user_id'] = auth()->user()->id;
        $model = auth()->user();

        // return response($model);
        // $data['']

        $model->platforms()->create($data);

        // return response()->json($data);

        // Platform::create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.platforms.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Platform created');
    }

    // public function update(Request $request, UserSocialMedia $userSocialMedia)
    // {
    //     $userSocialMedia->update(
    //         $request->validate([
    //             'social_media_id' => "required|exists:social_medias,id|unique:social_media_user,social_media_id,$userSocialMedia->id",
    //             'url' => 'required|max:255|string|url:https',
    //         ])
    //     );

    //     $page = $request?->page;
    //     $search = $request?->search;

    //     return to_route('admin.usersocialmedias.index', [
    //         'search' => $search,
    //         'page' => $page
    //     ])->with('flash', 'User social Media Updated');
    // }

    // public function destroy(Request $request, UserSocialMedia $userSocialMedia)
    // {
    //     $userSocialMedia->delete();

    //     $page = $request?->page;
    //     $search = $request?->search;

    //     return to_route('admin.usersocialmedias.index', [
    //         'search' => $search,
    //         'page' => $page
    //     ]);
    // }
}
