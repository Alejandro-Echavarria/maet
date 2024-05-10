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
                'taxt_id_number'  => 'nullable|max:255|string',
                'country'         => 'nullable|max:255|string',
                'city'            => 'nullable|max:255|string',
                'state'           => 'nullable|max:255|string',
                'street'          => 'nullable|max:255|string',
                'zip_code'        => 'nullable|max:50|string',
                'email'           => 'required|email|max:255',
                'phone'           => 'nullable|max:15',
            ],
            [],
            [
                'company_type_id' => 'company type',
                'taxt_id_number'  => 'tax id number',
                'zip_code'        => 'zip code',
            ]
        );

        Company::create($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.companies.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Company created');
    }

    public function update(Company $company, Request $request)
    {
        $request['slug'] = Str::slug($request->name);
        $data = $request->validate(
            [
                'company_type_id' => 'required|exists:company_types,id',
                'slug'            => "required|unique:companies,slug,$company->id",
                'name'            => "required|max:255|unique:companies,name,$company->id",
                'bio'             => 'required|string',
                'taxt_id_number'  => 'nullable|max:255|string',
                'country'         => 'nullable|max:255|string',
                'city'            => 'nullable|max:255|string',
                'state'           => 'nullable|max:255|string',
                'street'          => 'nullable|max:255|string',
                'zip_code'        => 'nullable|max:50|string',
                'email'           => 'required|email|max:255',
                'phone'           => 'nullable|max:15',
            ],
            [],
            [
                'company_type_id' => 'company type',
                'taxt_id_number'  => 'tax id number',
                'zip_code'        => 'zip code',
            ]
        );

        $company->update($data);

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.companies.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Company updated');
    }

    public function destroy(Request $request, Company $company)
    {
        if ($company->id === 1) {
            return to_route('admin.companies.index')->withErrors(['delete' => 'The default company cannot be deleted.']);
        }

        $company->delete();

        $page = $request?->page;
        $search = $request?->search;

        return to_route('admin.jobs.index', [
            'search' => $search,
            'page' => $page
        ])->with('flash', 'Job Deleted');
    }
}
