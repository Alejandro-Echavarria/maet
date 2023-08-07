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
        $request->validate([
            'name' => 'required|max:255|string',
            'icon' => 'required|max:25|string',
        ]);

        $data = $request->all();

        $socialMedia = SocialMedia::create($data);

        return redirect()->route('admin.socialmedias.index');
    }
}
