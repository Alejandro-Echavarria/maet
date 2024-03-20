<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TechnologyController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $technologies = Technology::filter($filter)
            ->paginate(10);

        return Inertia::render('Admin/Technologies/Index', compact('page', 'filter', 'technologies'));
    }
}
