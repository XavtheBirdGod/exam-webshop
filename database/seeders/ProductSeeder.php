<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller = User::where('role', 'seller')->first();
        
        $shop = Shop::create([
            'user_id' => $seller->id,
            'name' => 'Botanical Archive Store',
            'description' => 'Premium collection of jewelry and art.',
            'slug' => 'botanical-archive',
        ]);

        $products = [
            [
                'name' => 'Sacred Lotus Elixir',
                'description' => 'A tranquil blend of sacred lotus and jujube.',
                'price' => 29.50,
            ],
            [
                'name' => 'Aura Ritual Candle',
                'description' => 'Scented with amber and dark oud.',
                'price' => 45.00,
            ],
            [
                'name' => 'Golden Bloom Necklace',
                'description' => 'Handcrafted 18k gold plated necklace.',
                'price' => 120.00,
            ],
        ];

        foreach ($products as $p) {
            Product::create(array_merge($p, ['shop_id' => $shop->id]));
        }
    }
}
