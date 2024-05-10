<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('companyType:id,name')->paginate(10);
        $companyTypes = CompanyType::all();

        return Inertia::render('Admin/Companies/Index', compact('companies', 'companyTypes'));
    }

    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate(
            [
                'company_type_id' => 'required|exists:company_types,id',
                'slug'            => 'required|unique:companies',
                'name'            => 'required|max:255|string',
                'bio'             => 'required|string',
                'taxt_id_number'  => 'required|max:255|string',
                'country'         => 'required|max:255|string',
                'city'            => 'required|max:255|string',
                'state'           => 'required|max:255|string',
                'street'          => 'required|max:255|string',
                'zip_code'        => 'required|max:50|string',
                'email'           => 'required|email|max:255',
                'phone'           => 'required|max:15',
            ],
            [],
            [
                'company_type_id' => 'company type',
                'taxt_id_number'   => 'tax id number',
                'zip_code'        => 'zip code',
            ]
        );

        Company::create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.companies.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Company Created');
    }
}
