<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $clients = Client::filter($filter)->paginate(10);

        return Inertia::render('Admin/Clients/Index', compact('page', 'filter', 'clients'));
    }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'first_name'  => "required|max:255|string",
                'last_name'   => "required|max:255|string",
                'email'       => "nullable|email|max:255",
                'phone'       => "nullable|max:45|string",
                'country'     => "nullable|max:255|string",
                'description' => "nullable|string",
                'file'        => "nullable|image",
            ],
            [
                // Custom error messages
            ],
            [
                // Custom attribute names
                'file' => 'image',
            ]
        );

        Client::create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.clients.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Client created');
    }
}
