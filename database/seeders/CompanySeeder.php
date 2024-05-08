<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'company_type_id' => 1,
            'slug'            => 'maet',
            'name'            => 'MAET',
            'bio'             => 'default',
            'email'           => 'default@default.com',
        ]);
    }
}
