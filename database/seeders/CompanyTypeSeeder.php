<?php

namespace Database\Seeders;

use App\Models\CompanyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyType::create([
            'slug' => 'personal',
            'name' => 'personal',
        ]);

        CompanyType::create([
            'slug' => 'company',
            'name' => 'company',
        ]);
    }
}
