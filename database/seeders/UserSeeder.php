<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\SuperAdmin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Customer
        $customerUser = User::create([
            'name' => 'Customer User',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'), // hashed password
        ]);

        Customer::create([
            'user_id' => $customerUser->id,
            'phone_number' => '1234567890',
        ]);

        // Create Admin
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'phone_number' => '0987654321',
        ]);

        // Create Super Admin
        $superAdminUser = User::create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        SuperAdmin::create([
            'user_id' => $superAdminUser->id,
            'phone_number' => '1122334455',
        ]);
    }
}
