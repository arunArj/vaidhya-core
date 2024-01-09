<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Patients;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // User::factory(10)->create();
       Patients::factory(20)->create();
      User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@demo.com',
            'password' =>Hash::make('12345678'),
        ]);
    }
}
