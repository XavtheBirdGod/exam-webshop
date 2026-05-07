<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $products = Product::all();

        if ($admin && $products->count() > 0) {
            // Order 1: Delivered
            $order1 = Order::create([
                'user_id' => $admin->id,
                'total_amount' => 74.50,
                'status' => 'delivered',
                'shipping_address' => $admin->shipping_address,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'created_at' => now()->subDays(10),
            ]);

            OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $products[0]->id,
                'quantity' => 1,
                'price' => $products[0]->price,
            ]);

            OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $products[1]->id,
                'quantity' => 1,
                'price' => $products[1]->price,
            ]);

            // Order 2: Processing
            $order2 = Order::create([
                'user_id' => $admin->id,
                'total_amount' => 120.00,
                'status' => 'processing',
                'shipping_address' => $admin->shipping_address,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'created_at' => now()->subDays(2),
            ]);

            OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $products[2]->id,
                'quantity' => 1,
                'price' => $products[2]->price,
            ]);
        }
    }
}
