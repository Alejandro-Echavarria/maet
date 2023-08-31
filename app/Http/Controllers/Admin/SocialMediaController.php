<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Inertia\Inertia;

class SocialMediaController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $socialMedias = SocialMedia::orderBy('created_at', 'desc')
            ->filter($filter)
            ->paginate(10);

        return Inertia::render('Admin/SocialMedias/Index', compact('socialMedias', 'filter', 'page'));
    }

    public function store(Request $request)
    {
        SocialMedia::create(
            $request->validate([
                'name' => "required|max:255|string|unique:social_medias,name,$request->id",
                'icon' => 'required|max:25|string',
            ])
        );

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.socialmedias.index', [
            'search' => $search,
            'page' => $page
        ]);
    }

    public function update(Request $request, SocialMedia $socialMedia)
    {
        $socialMedia->update(
            $request->validate([
                'name' => "required|max:255|string|unique:social_medias,name,$socialMedia->id",
                'icon' => 'required|max:25|string',
            ])
        );

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.socialmedias.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Social Media Updated');
    }

    public function destroy(Request $request, SocialMedia $socialMedia)
    {
        $socialMedia->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.socialmedias.index', [
            'search' => $search,
            'page' => $page
        ]);
    }
}
