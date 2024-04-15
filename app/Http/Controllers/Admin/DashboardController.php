<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Job;
use App\Models\Message;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            $jobs = ['label' => 'Jobs (projects)', 'total' => Job::all()->count(), 'route' => 'admin.jobs.index'],
            $clients = ['label' => 'Clients', 'total' => Client::all()->count(), 'route' => 'admin.clients.index'],
            $message = ['label' => 'Messages', 'total' => Message::all()->count(), 'route' => null],
        ];

        return Inertia::render('Admin/Dashboard', compact('data'));
    }
}
