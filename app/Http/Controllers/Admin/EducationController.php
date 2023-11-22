<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Education;
use App\Models\Experience;
use Carbon\Carbon;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('start_date', 'desc')->get();

        return Inertia::render('Admin/Educations/Index', compact('educations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => "required|max:255|string|unique:education,title",
            'description' => 'required',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
            'color' => 'required|max:10|string',
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date'])->format('Y-m-d');

        Education::create($data);

        return to_route('admin.resume.educations.index');
    }

    public function update(Request $request, Education $education)
    {
        $data = $request->validate([
            'title' => "required|max:255|string|unique:education,title,$education->id",
            'description' => 'required',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
            'color' => 'required|max:10|string',
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date'])->format('Y-m-d');

        $education->update($data);

        return to_route('admin.resume.educations.index');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return to_route('admin.resume.educations.index');
    }
}
