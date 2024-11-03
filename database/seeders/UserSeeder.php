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
        $customerRole = Role::where('role', 'customer')->first();
        $adminRole = Role::where('role', 'admin')->first();

        if (!$customerRole || !$adminRole) {
            $this->command->info('Roles not found. Make sure the roles exist in the roles table.');
            return;
        }

        // Users
        for ($i = 1; $i <= 4; $i++) {
            User::create([
                'name' => 'Customer User ' . $i,
                'username' => 'customer' . $i,
                'email' => 'customer' . $i . '@gmail.com',
                'phone_number' => '08589264582' . $i,
                'role_id' => $customerRole->id,
                'address_id' => $i,
                'password' => Hash::make('password'),
            ]);
        }

        // Admins
        for ($i = 1; $i <= 8; $i++) {
            User::create([
                'name' => 'Admin User ' . $i,
                'username' => 'admin' . $i,
                'email' => 'admin' . $i . '@gmail.com',
                'phone_number' => '08589264585' . $i,
                'role_id' => $adminRole->id,
                'address_id' => $i + 10,
                'password' => Hash::make('password'),
            ]);
        }

        // Super Admin
        User::create([
            'name' => 'Super Admin User',
            'username' => 'superadmin1',
            'email' => 'superadmin@gmail.com',
            'phone_number' => '08589264581',
            'role_id' => 3,
            'address_id' => 3,
            'password' => Hash::make('password'),
        ]);
    }
}
