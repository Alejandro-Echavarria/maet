<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AboutMeController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/AboutMe/Index');
    }
}
