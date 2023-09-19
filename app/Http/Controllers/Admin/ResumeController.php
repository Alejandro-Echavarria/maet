<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use App\Models\Knowledge;
use App\Models\WorkingSkill;

class ResumeController extends Controller
{
    public function index()
    {
        $educations = Education::all();
        $experiences = Experience::all();
        $jobs = Job::all();
        $workingSkills = WorkingSkill::all();
        $knows = Knowledge::all();

        return Inertia::render('Admin/Resume/Index', compact('educations', 'experiences', 'jobs', 'workingSkills', 'knows'));
    }
}
