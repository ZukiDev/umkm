<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users to associate with the addresses
        $users = User::all();

        // Check if users exist before seeding addresses
        if ($users->isEmpty()) {
            $this->command->info('No users found, skipping Address seeder.');
            return;
        }

        // Create sample addresses for each user
        foreach ($users as $user) {
            Address::create([
                'user_id' => $user->id,
                'address' => $user->id . ' Main Street',
                'province' => 'Central Province',
                'city' => 'Main City',
                'district' => 'Main District',
                'post_code' => '12345',
                'delivery_instructions' => 'Leave at the front door',
            ]);
        }

        $this->command->info('Addresses seeded successfully!');
    }
}
