<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::select(['name', 'email', 'position'])->first();

        return Inertia::render('Welcome', compact('user'));
    }
}
