<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use App\Models\Role;
use App\Models\Address;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Seed the stores table with users having the 'umkm' role.
     */
    public function run(): void
    {
        // Find the 'umkm' role
        $umkmRole = Role::where('role', 'admin')->first();

        // Check if the 'umkm' role exists
        if (!$umkmRole) {
            $this->command->info('No umkm role found, skipping Store seeder.');
            return;
        }

        // Get all users with the 'umkm' role
        $users = User::where('role_id', $umkmRole->id)->get();

        if ($users->isEmpty()) {
            $this->command->info('No users with umkm role found, skipping Store seeder.');
            return;
        }

        // Get available addresses from the 'addresses' table
        $addresses = Address::all();

        // Ensure there are addresses available
        if ($addresses->isEmpty()) {
            $this->command->info('No addresses found, skipping Store seeder.');
            return;
        }

        // Create sample stores for each user with the umkm role
        foreach ($users as $user) {
            Store::create([
                'user_id' => $user->id, // Assuming you have a user relationship set
                'store_name' => 'UMKM Store ' . $user->id,
                'description' => 'Description for umkm Store ' . $user->id,
                'owner_name' => 'Owner ' . $user->id,
                'address_id' => $addresses->random()->id, // Randomly assign an address from the addresses table
                'email' => 'umkm_store' . $user->id . '@example.com',
                'phone_number' => '123-456-789' . $user->id,
                'business_type' => 'Retail',
                'status' => true,
                'logo' => 'https://example.com/logo_umkm' . $user->id . '.png',
                'created_by' => $user->id,
            ]);
        }
    }
}
