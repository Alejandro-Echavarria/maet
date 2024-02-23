<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Knowledge;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KnowleedgeController extends Controller
{
    public function index()
    {
        $knowledge = Knowledge::orderBy('created_at', 'desc')->get();

        return Inertia::render('Admin/Knowledge/Index', compact('knowledge'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => "required|max:255|string|unique:knowledge,name",
            'icon'  => 'required|string',
            'main'  => "boolean",
        ]);

        $data['user_id'] = auth()->user()->id;

        Knowledge::create($data);

        return to_route('admin.resume.knowledge.index');
    }

    public function update(Request $request, Knowledge $knowledge)
    {
        $data = $request->validate([
            'name' => "required|max:255|string|unique:knowledge,name,$knowledge->id",
            'icon'  => 'required|string',
            'main'  => "required|boolean",
        ]);

        $data['user_id'] = auth()->user()->id;

        $knowledge->update($data);

        return to_route('admin.resume.knowledge.index');
    }

    public function destroy(Knowledge $knowledge)
    {
        $knowledge->delete();

        return to_route('admin.resume.knowledge.index');
    }
}
