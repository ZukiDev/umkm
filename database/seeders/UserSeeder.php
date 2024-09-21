<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Customer
        User::create([
            'name' => 'Customer User',
            'username' => 'customer1',
            'email' => 'customer@gmail.com',
            'phone_number' => '1234567890',
            'role_id' => 1,
            'password' => Hash::make('password'), // hashed password
        ]);

        // Create Admin
        User::create([
            'name' => 'Admin User',
            'username' => 'admin1',
            'email' => 'admin@gmail.com',
            'phone_number' => '0987654321',
            'role_id' => 2,
            'password' => Hash::make('password'),
        ]);

        // Create Super Admin
        User::create([
            'name' => 'Super Admin User',
            'username' => 'superadmin1',
            'email' => 'superadmin@gmail.com',
            'phone_number' => '1122334455',
            'role_id' => 3,
            'password' => Hash::make('password'),
        ]);
    }
}
