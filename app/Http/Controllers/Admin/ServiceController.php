<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $services = Service::filter($filter)
            ->orderBy('services.created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Admin/Services/Index', compact('services', 'page', 'filter'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => "required|max:55|string|unique:services,name,$request->name",
            'icon'        => 'nullable|string',
            'description' => 'required|string',
            'color'       => 'required|max:255|string'
        ]);

        $data['user_id'] = auth()->user()->id;

        Service::create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.services.index', [
            'search' => $search,
            'page'   => $page
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $service->update(
            $request->validate([
                'name'        => "required|max:55|string|unique:services,name,$service->id",
                'icon'        => 'nullable|string',
                'description' => 'required|string',
                'color'       => 'required|max:255|string'
            ])
        );

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.services.index', [
            'search' => $search,
            'page'   => $page
        ]);
    }

    public function destroy(Request $request, Service $service)
    {
        $service->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.services.index', [
            'search' => $search,
            'page'   => $page
        ]);
    }
}
