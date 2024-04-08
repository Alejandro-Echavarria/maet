<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    protected $directory;

    public function __construct()
    {
        $this->directory = 'images/clients';
    }

    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $clients = Client::with(
            [
                'images' => function ($query) {
                    $query->select('id', 'url', 'default', 'imageable_id')
                        ->where('default', '=', '1')
                        ->orderBy('id', 'desc');
                }
            ]
        )
            ->filter($filter)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Admin/Clients/Index', compact('page', 'filter', 'clients'));
    }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'first_name'  => "required|max:255|string",
                'last_name'   => "required|max:255|string",
                'email'       => "nullable|email|max:255",
                'phone'       => "nullable|numeric",
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

        $client = Client::create($data);

        if ($request->file('file')) {
            ImageController::store($request->file('file'), $client, $this->directory, 'admin');
        }

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.clients.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Client created');
    }

    public function update(Request $request, Client $client)
    {
        // return response()->json("app/admin/" . $client->images()->select('url')->where('default', '=', '1')->first()->url);

        $data = $request->validate(
            [
                'first_name'  => "required|max:255|string",
                'last_name'   => "required|max:255|string",
                'email'       => "nullable|email|max:255",
                'phone'       => "nullable|numeric",
                'country'     => "nullable|max:255|string",
                'description' => "nullable|string",
                'file'        => $request->file('file') ? "nullable|image" : "nullable|string",
            ],
            [
                // Custom error messages
            ],
            [
                // Custom attribute names
                'file' => 'image',
            ]
        );

        $client->update($data);

        if ($request->file('file')) {
            ImageController::store($request->file('file'), $client, $this->directory, 'admin');
        }

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.clients.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Client updated');
    }

    public function destroy(Request $request, Client $client)
    {
        $client->delete();
        ImageController::destroy($client, 'admin');

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.clients.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Client updated');
    }
}
