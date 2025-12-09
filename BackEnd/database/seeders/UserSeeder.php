<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'super@admin.com',
            'phone' => '0123456789',
            'address' => '123 Admin Street',
            'role' => 'Admin', // default role
            'password' => Hash::make('password123'), // default password
        ]);
    }
}
