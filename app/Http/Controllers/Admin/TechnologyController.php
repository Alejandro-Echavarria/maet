<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate([
            'name'  => "required|max:255|string|unique:technologies",
            'slug'  => "required|unique:technologies",
            'icon'  => 'required|string',
            'main'  => "boolean",
            'color' => "required|max:255|string",
        ]);

        Technology::create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.technologies.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Technology Created');
    }

    public function update(Request $request, Technology $technology)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate([
            'slug'  => "required|unique:technologies,slug,$technology->id",
            'name'  => "required|max:255|string|unique:technologies,name,$technology->id",
            'icon'  => 'required|string',
            'main'  => "boolean",
            'color' => "required|max:255|string",
        ]);

        $technology->update($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.technologies.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Technology Created');
    }

    public function destroy(Request $request, Technology $technology)
    {
        $technology->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.technologies.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Technology Created');
    }
}
