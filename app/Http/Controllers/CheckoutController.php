<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Add shipping
        $shippingCountry = session()->get('shipping_country');
        $shippingAddress = session()->get('shipping_address');

        if (!$shippingCountry || !$shippingAddress) {
            return response()->json(['error' => 'Please provide a shipping country and address.'], 422);
        }

        $shippingCost = $this->calculateShipping($shippingCountry);
        $total = $subtotal + $shippingCost;

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $total * 100, // cents
                'currency' => strtolower(tenant('currency') ?? 'eur'),
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'user_id' => auth()->id(),
                    'tenant_id' => tenant('id'),
                ]
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function calculateShipping($country)
    {
        if (!$country) return 0;

        $currentShopLocation = tenant('id');
        
        $domesticCountries = [
            'amsterdam' => 'Netherlands',
            'paris' => 'France',
            'london' => 'United Kingdom'
        ];

        $domesticCountry = $domesticCountries[$currentShopLocation] ?? null;

        if ($country === $domesticCountry) {
            return 5.00;
        }

        return 15.00;
    }

    public function success(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop');
        }

        DB::transaction(function () use ($cart) {
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $shippingCountry = session()->get('shipping_country');
            $shippingAddress = session()->get('shipping_address') ?? (auth()->check() ? auth()->user()->shipping_address : 'Pickup in Store');
            $shippingCost = $this->calculateShipping($shippingCountry);
            $total = $subtotal + $shippingCost;

            $order = Order::create([
                'user_id' => auth()->id() ?? 1,
                'total_amount' => $total,
                'status' => 'processing',
                'shipping_address' => $shippingAddress,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            ]);

            if (auth()->check()) {
                $user = auth()->user();
                if (!$user->shipping_address || $user->shipping_address !== $shippingAddress) {
                    $user->shipping_address = $shippingAddress;
                    $user->save();
                }
            }

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['variant_id'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Update stock
                if (isset($item['variant_id'])) {
                    $variant = \App\Models\ProductVariant::find($item['variant_id']);
                    if ($variant) {
                        $variant->decrement('stock', $item['quantity']);
                    }
                } else {
                    $product = Product::find($item['product_id']);
                    if ($product) {
                        $product->decrement('stock', $item['quantity']);
                    }
                }
            }
        });

        session()->forget(['cart', 'shipping_country', 'shipping_address']);

        return view('pages.success');
    }
}
