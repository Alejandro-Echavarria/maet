<?php

namespace Database\Seeders;

use App\Models\ClientType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientType::create([
            'name' => 'Lead',
            'slug' => 'lead',
        ]);

        ClientType::create([
            'name' => 'Client',
            'slug' => 'client',
        ]);

        ClientType::create([
            'name' => 'Company',
            'slug' => 'company',
        ]);
    }
}
