<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@wtnblasting.com'],
            [
                'name' => 'Admin WTN Blasting',
                'password' => Hash::make('password123'), // GANTI setelah login pertama!
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Dummy landing settings, products, testimonials & queue orders
        // so the redesigned landing page has enough content to preview.
        $this->call(LandingDemoSeeder::class);
    }
}
