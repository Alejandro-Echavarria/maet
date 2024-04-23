<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientType;
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
                'clientType:id,name,slug,color',
                'jobs' => function ($query) {
                    $query->select('id', 'client_id', 'slug', 'title', 'price', 'status', 'created_at')->orderBy('created_at', 'desc');
                },
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

        $clientTypes = ClientType::select('id', 'name')->get();

        return Inertia::render('Admin/Clients/Index', compact('page', 'filter', 'clients', 'clientTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'client_type_id' => 'required|exists:client_types,id',
                'first_name'     => "required|max:255|string",
                'last_name'      => "required|max:255|string",
                'email'          => "nullable|email|max:255",
                'phone'          => "nullable|numeric",
                'country'        => "nullable|max:255|string",
                'description'    => "nullable|string",
                'status'         => "required|boolean",
                'file'           => "nullable|image",
            ],
            [
                // Custom error messages
            ],
            [
                // Custom attribute names
                'file' => 'image',
                'client_type_id' => 'client type',
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
        $data = $request->validate(
            [
                'client_type_id' => 'required|exists:client_types,id',
                'first_name'     => "required|max:255|string",
                'last_name'      => "required|max:255|string",
                'email'          => "nullable|email|max:255",
                'phone'          => "nullable|numeric",
                'country'        => "nullable|max:255|string",
                'description'    => "nullable|string",
                'status'         => "required|boolean",
                'file'           => $request->file('file') ? "nullable|image" : "nullable|string",
            ],
            [
                // Custom error messages
            ],
            [
                // Custom attribute names
                'file' => 'image',
                'client_type_id' => 'client type',
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

    public function clientJobs(Client $client)
    {
        return response()->json($client->jobs->select('id', 'client_id', 'slug', 'title', 'price'));
    }
}
