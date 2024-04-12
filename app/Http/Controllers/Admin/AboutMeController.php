<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ImageController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Carbon\Carbon;

class AboutMeController extends Controller
{
    protected $directoryCkeditor;

    public function __construct()
    {
        $this->directoryCkeditor = 'images/ckeditor/aboutme';
    }

    public function index()
    {
        return Inertia::render('Admin/AboutMe/Index');
    }

    public function ckeditorMoveToStorage(Request $request)
    {
        $request->validate([
            'upload' => "required|image"
        ]);

        $url = ImageController::ckeditorMoveToStorage($request->file('upload'), $this->directoryCkeditor);

        return $url;
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

        ImageController::ckeditorUpdate($user, $user['bio'], $this->directoryCkeditor);

        return to_route('admin.aboutme.index');
    }
}
