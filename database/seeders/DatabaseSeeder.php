<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@ngo.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        $designations = ['President', 'Vice President', 'Secretary', 'Treasurer', 'Member', 'Volunteer'];
        foreach ($designations as $name) {
            \App\Models\Designation::create(['name' => $name]);
        }
        
        \App\Models\Setting::create(['key' => 'total_projects', 'value' => '45']);
    }
}
