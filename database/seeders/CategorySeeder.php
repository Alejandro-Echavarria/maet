<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Web',
            'slug' => 'web',
        ]);

        Category::create([
            'name' => 'Data bases',
            'slug' => 'data-bases',
        ]);
    }
}
