<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Platform;
use App\Models\PlatformType;
use App\Models\User;
use Illuminate\Validation\Rule;
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
        $entity = Company::select('id', 'company_type_id')->orderBy('id')->first();

        $model = $entity->id === 1 ? User::select('id')->where('id', auth()->user()->id)->first() : $entity;
        $model->platformable_id = $model->id;
        $model->platformable_type = $entity->company_type_id === 1 ? User::class : Company::class;

        $data = $request->validate(
            [
                'platform_type_id' => [
                    'required',
                    'exists:platform_types,id',
                    Rule::unique('platforms', 'platform_type_id')->where('platformable_type', $model->platformable_type)->where('platformable_id', $model->id),
                ],
                'url' => 'required|max:255|string|url:https',
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
        $entity = Company::select('id', 'company_type_id')->orderBy('id')->first();

        $model = $entity->id === 1 ? User::select('id')->where('id', auth()->user()->id)->first() : $entity;
        $platform->platformable_id = $model->id;
        $platform->platformable_type = $entity->company_type_id === 1 ? User::class : Company::class;

        $platform->update(
            $request->validate(
                [
                    'platform_type_id' => [
                        'required',
                        'exists:platform_types,id',
                        Rule::unique('platforms', 'platform_type_id')->ignore($platform->id)->where('platformable_type', $platform->platformable_type)->where('platformable_id', $model->id),
                    ],
                    'url' => 'required|max:255|string|url:https',
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
