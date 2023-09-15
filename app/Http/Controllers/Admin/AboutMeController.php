<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Carbon\Carbon;

class AboutMeController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/AboutMe/Index');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'position' => "required|max:45|string",
            'phone' => 'required|max:45',
            'address' => 'required|max:255|string',
            'bio' => 'required',
            'birthday' => 'required|date_format:d/m/Y'
        ]);

        $data['birthday'] = Carbon::createFromFormat('d/m/Y', $data['birthday'])->format('Y-m-d');

        $user->update($data);

        return to_route('admin.aboutme.index');
    }
}
