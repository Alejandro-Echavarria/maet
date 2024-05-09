<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('companyType:id,name')->paginate(10);
        $companyTypes = CompanyType::all();

        return Inertia::render('Admin/Companies/Index', compact('companies', 'companyTypes'));
    }
}
