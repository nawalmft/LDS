<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'a@b.c', 
            'password' => bcrypt('1234567890'), 
            'role' => 'admin',
            'phone' => '1234567890',
            'date_of_birth' => '2000-01-01',
            'gender' => 'male'

        ]);
    }
}
