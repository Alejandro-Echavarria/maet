<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Inertia\Inertia;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedias = SocialMedia::orderBy('created_at', 'desc')->get();

        return Inertia::render('Admin/SocialMedias/Index', compact('socialMedias'));
    }

    public function store(Request $request)
    {
        SocialMedia::create(
            $request->validate([
                'name' => "required|max:255|string|unique:social_medias,name,$request->id",
                'icon' => 'required|max:25|string',
            ])
        );

        return to_route('admin.socialmedias.index');;
    }

    public function update(Request $request, SocialMedia $socialmedia)
    {
        $socialmedia->update(
            $request->validate([
                'name' => "required|max:255|string|unique:social_medias,name,$socialmedia->id",
                'icon' => 'required|max:25|string',
            ])
        );

        return to_route('admin.socialmedias.index');
    }

    public function destroy(SocialMedia $socialmedia)
    {
        $socialmedia->delete();

        return to_route('admin.socialmedias.index');
    }
}
