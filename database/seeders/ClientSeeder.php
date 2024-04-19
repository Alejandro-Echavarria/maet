<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'client_type_id' => 1,
            'first_name'     => 'Manuel Alejandro',
            'last_name'      => 'Echavarria Taveras',
            'email'          => 'echavarria_007@hotmail.com',
        ]);
    }
}
