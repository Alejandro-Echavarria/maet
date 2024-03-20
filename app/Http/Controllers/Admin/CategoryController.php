<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $categories = Category::filter($filter)
            ->paginate(10);

        return Inertia::render('Admin/Categories/Index', compact('page', 'filter', 'categories'));
    }

    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate([
            'slug' => "required|unique:categories",
            'name' => "required|max:255|string",
        ]);

        Category::create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.categories.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Category Created');
    }

    public function update(Request $request, Category $category)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate([
            'slug' => "required|unique:categories,slug,$category->id",
            'name' => "required|max:255|string",
        ]);

        $category->update($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.categories.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Category Updated');
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.categories.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Category Updated');
    }
}
