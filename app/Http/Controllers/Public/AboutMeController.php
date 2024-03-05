<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AboutMeController extends Controller
{
    public function index()
    {
        return Inertia::render('Public/AboutMe/Index');
    }
}
