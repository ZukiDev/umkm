<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles (assuming role IDs are 1 for customer and 2 for admin)
        $customerRole = Role::where('role', 'customer')->first();
        $adminRole = Role::where('role', 'admin')->first();

        if (!$customerRole || !$adminRole) {
            $this->command->info('Roles not found. Make sure the roles exist in the roles table.');
            return;
        }

        // Create 10 Customer users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Customer User ' . $i,
                'username' => 'customer' . $i,
                'email' => 'customer' . $i . '@gmail.com',
                'phone_number' => '123456789' . $i,
                'role_id' => $customerRole->id,
                'address_id' => $i, // Assuming address seeder or static value will be used
                'password' => Hash::make('password'), // hashed password
            ]);
        }

        // Create 10 Admin users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Admin User ' . $i,
                'username' => 'admin' . $i,
                'email' => 'admin' . $i . '@gmail.com',
                'phone_number' => '098765432' . $i,
                'role_id' => $adminRole->id,
                'address_id' => $i + 10, // Assuming address seeder or static value will be used
                'password' => Hash::make('password'),
            ]);
        }

        // Create Super Admin
        User::create([
            'name' => 'Super Admin User',
            'username' => 'superadmin1',
            'email' => 'superadmin@gmail.com',
            'phone_number' => '1122334455',
            'role_id' => 3,
            'address_id' => 3,
            'password' => Hash::make('password'),
        ]);
    }
}
