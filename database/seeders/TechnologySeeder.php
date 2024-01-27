<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Technology::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
            'icon' => 'laravel',
        ]);

        Technology::create([
            'name' => 'Vue',
            'slug' => 'vue',
            'icon' => 'vue',
        ]);
    }
}
