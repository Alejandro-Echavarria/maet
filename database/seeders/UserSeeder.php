<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Manuel Echavarria',
            'email' => 'echavarria_007@hotmail.com',
            'position' => 'Software engineer & web developer',
            'password' => bcrypt('manuel0.3')
        ]);
    }
}
