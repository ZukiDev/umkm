<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Customer
        Role::create([
            'role' => 'customer',
        ]);
        // Create Admin
        Role::create([
            'role' => 'admin',
        ]);
        // Create Super Admin
        Role::create([
            'role' => 'superAdmin',
        ]);
    }
}
