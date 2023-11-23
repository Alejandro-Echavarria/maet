<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Experience;
use Carbon\Carbon;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::all();

        return Inertia::render('Admin/Experiences/Index', compact('experiences'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => "required|max:255|string|unique:experiences,title",
            'description' => 'required',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
            'color' => 'required|max:10|string',
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date'])->format('Y-m-d');

        Experience::create($data);

        return to_route('admin.resume.experiences.index');
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'title' => "required|max:255|string|unique:experiences,title,$experience->id",
            'description' => 'required',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
            'color' => 'required|max:10|string',
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date'])->format('Y-m-d');

        $experience->update($data);

        return to_route('admin.resume.experiences.index');
    }
}
