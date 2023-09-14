<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(10);

        return Inertia::render('Admin/Services/Index', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => "required|max:45|string|unique:services,title,$request->title",
            'icon' => 'required|max:25|string',
            'description' => 'required|max:255|string',
            'color' => 'required|max:255|string'
        ]);

        $data['user_id'] = auth()->user()->id;

        Service::create($data);

        return to_route('admin.services.index');
    }
}
