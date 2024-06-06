<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Response;

class AboutMeController extends Controller
{
    protected string $directoryCkeditor;

    public function __construct()
    {
        $this->directoryCkeditor = 'images/ckeditor/aboutme';
    }

    public function index(): Response
    {
        return Inertia::render('Admin/AboutMe/Index');
    }

    public function ckeditorMoveToStorage(Request $request): array
    {
        $request->validate([
            'upload' => "required|image"
        ]);

        return ImageController::ckeditorMoveToStorage($request->file('upload'), $this->directoryCkeditor);
    }

    public function update(Request $request, User $user): RedirectResponse
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
