<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlatformType;
use Inertia\Inertia;

class PlatformTypeController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $platformTypes = PlatformType::orderBy('created_at', 'desc')
            ->filter($filter)
            ->paginate(10);

        return Inertia::render('Admin/PlatformTypes/Index', compact('platformTypes', 'filter', 'page'));
    }

    public function store(Request $request)
    {
        PlatformType::create(
            $request->validate([
                'name' => "required|max:255|string|unique:platform_types,name,$request->id",
                'icon' => 'required|string',
            ])
        );

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.platformtypes.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Platform type created');
    }

    public function update(Request $request, PlatformType $platformType)
    {
        $platformType->update(
            $request->validate([
                'name' => "required|max:255|string|unique:platform_types,name,$platformType->id",
                'icon' => 'required|string',
            ])
        );

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.platformtypes.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Platform type updated');
    }

    public function destroy(Request $request, PlatformType $platformType)
    {
        $platformType->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.platformtypes.index', [
            'search' => $search,
            'page' => $page
        ]);
    }
}
