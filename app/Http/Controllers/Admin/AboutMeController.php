<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Inertia\Inertia;

class AboutMeController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/AboutMe/Index');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $socialMedia = SocialMedia::create($data);

        return response()->json([
            'success' => true,
            'data' => $socialMedia
        ]);
    }
}
