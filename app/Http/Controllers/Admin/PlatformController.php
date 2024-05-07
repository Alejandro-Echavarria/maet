<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\PlatformType;
use App\Models\User;
use Inertia\Inertia;

class PlatformController extends Controller
{
    public function index(Request $request)
    {
        $page = $request?->page;
        $filter = $request?->search;

        $platforms = Platform::with('platformType:id,name,icon')
            ->filter($filter)
            ->orderBy('platforms.created_at', 'desc')
            ->paginate(10);

        $platformTypes = PlatformType::get(['id', 'name']);

        return Inertia::render('Admin/Platforms/Index', compact('platforms', 'platformTypes', 'page', 'filter'));
    }

    public function store(Request $request)
    {
        $model = User::select('id')->first();
        $model->platformable_type = User::class;

        $data = $request->validate(
            [
                'platform_type_id' => "required|exists:platform_types,id|unique:platforms|unique:platforms,platformable_id,$model->id|unique:platforms,platformable_type," . $model->platformable_type,
                'url'              => 'required|max:255|string|url:https',
            ],
            [
                '',
            ],
            [
                'platform_type_id' => 'platform',
            ]
        );

        $model->platforms()->create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.platforms.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Platform created');
    }

    public function update(Request $request, Platform $platform)
    {
        $model = User::select('id')->first();
        $platform->platformable_type = User::class;

        $platform->update(
            $request->validate(
                [
                    'platform_type_id' => "required|exists:platform_types,id|unique:platforms,platform_type_id,$platform->id|unique:platforms,platformable_id,$model->id|unique:platforms,platformable_type,".$platform->platformable_type,
                    'url'              => 'required|max:255|string|url:https',
                ],
                [
                    '',
                ],
                [
                    'platform_type_id' => 'platform',
                ]
            )
        );

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.platforms.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Platform updated');
    }

    public function destroy(Request $request, Platform $platform)
    {
        $platform->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.platforms.index', [
            'search' => $search,
            'page' => $page
        ]);
    }
}
