<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy Admin - Max Soulmate Level
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '+31 6 12345678',
            'shipping_address' => 'Amsterdam Central Station, Amsterdam',
            'birthday' => '1990-01-01',
            'soulmate_level' => 3,
        ]);

        // Dummy Seller
        User::create([
            'name' => 'Seller User',
            'email' => 'seller@example.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'phone_number' => '+31 6 87654321',
            'shipping_address' => 'Keizersgracht 123, Amsterdam',
            'birthday' => '1985-05-15',
            'soulmate_level' => 2,
        ]);

        // Dummy Customer
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone_number' => '+31 6 11223344',
            'shipping_address' => 'Dam Square 1, Amsterdam',
            'birthday' => '1995-10-20',
            'soulmate_level' => 1,
        ]);
    }
}
