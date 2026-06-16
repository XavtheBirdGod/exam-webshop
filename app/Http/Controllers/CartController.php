<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $shippingCountry = session()->get('shipping_country');
        $shippingAddress = session()->get('shipping_address') ?? (auth()->check() ? auth()->user()->shipping_address : null);
        
        $shippingCost = $this->calculateShipping($shippingCountry);
        $grandTotal = $total + $shippingCost;

        return view('pages.cart', compact('cart', 'total', 'shippingCost', 'grandTotal', 'shippingCountry', 'shippingAddress'));
    }

    private function calculateShipping($country)
    {
        if (!$country) return 0;

        $currentShopLocation = tenant('id'); // amsterdam, paris, london
        
        $domesticCountries = [
            'amsterdam' => 'Netherlands',
            'paris' => 'France',
            'london' => 'United Kingdom'
        ];

        $domesticCountry = $domesticCountries[$currentShopLocation] ?? null;

        if ($country === $domesticCountry) {
            return 5.00; // Domestic shipping
        }

        return 15.00; // International shipping
    }

    public function updateShipping(Request $request)
    {
        $request->validate(['country' => 'required|string']);
        
        session()->put('shipping_country', $request->country);
        
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingCost = $this->calculateShipping($request->country);
        $grandTotal = $subtotal + $shippingCost;

        return response()->json([
            'success' => true,
            'shipping_cost' => number_format($shippingCost, 2),
            'grand_total' => number_format($grandTotal, 2)
        ]);
    }

    public function updateAddress(Request $request)
    {
        $request->validate(['address' => 'required|string|min:10']);
        
        session()->put('shipping_address', $request->address);

        if (auth()->check()) {
            $user = auth()->user();
            $user->shipping_address = $request->address;
            $user->save();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Shipping address updated.'
        ]);
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $variant = null;
        $price = $product->price;
        $sizeName = 'Standard';
        $stock = $product->stock;
        $key = $product->id . '-default';

        if ($request->has('variant_id') && $request->variant_id) {
            $variant = \App\Models\ProductVariant::findOrFail($request->variant_id);
            $price += $variant->additional_price;
            $sizeName = $variant->value;
            $stock = $variant->stock;
            $key = $product->id . '-' . $variant->id;
        }

        $cart = session()->get('cart', []);
        $currentQty = isset($cart[$key]) ? $cart[$key]['quantity'] : 0;

        if ($currentQty + 1 > $stock) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only ' . $stock . ' units available in stock.'
                ], 422);
            }
            return redirect()->back()->with('error', 'Only ' . $stock . ' units available in stock.');
        }

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
            // Ensure all keys exist for legacy sessions
            $cart[$key]['product_id'] = $cart[$key]['product_id'] ?? $product->id;
            $cart[$key]['max_stock'] = $stock;
            $cart[$key]['size'] = $cart[$key]['size'] ?? $sizeName;
        } else {
            $cart[$key] = [
                "product_id" => $product->id,
                "variant_id" => $variant ? $variant->id : null,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $price,
                "size" => $sizeName,
                "img" => $product->image_url,
                "collection" => $product->collection,
                "max_stock" => $stock
            ];
        }

        session()->put('cart', $cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ritual (' . $sizeName . ') added to your bag.',
                'cart_count' => $cartCount
            ]);
        }

        return redirect()->to(url()->previous())->with('success', 'Ritual (' . $sizeName . ') added to your bag.');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            
            if (isset($cart[$request->id])) {
                $requestedQty = (int) $request->quantity;
                
                // Fallback for legacy items missing max_stock
                if (!isset($cart[$request->id]['max_stock'])) {
                    $prodId = $cart[$request->id]['product_id'] ?? explode('-', $request->id)[0];
                    $cart[$request->id]['max_stock'] = Product::find($prodId)->stock ?? 99;
                }

                $maxStock = $cart[$request->id]['max_stock'];

                if ($requestedQty > $maxStock) {
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Only ' . $maxStock . ' units available.'
                        ], 422);
                    }
                    return redirect()->back()->with('error', 'Insufficient stock.');
                }

                $cart[$request->id]["quantity"] = max(1, $requestedQty);
                session()->put('cart', $cart);

                $itemTotal = $cart[$request->id]["quantity"] * $cart[$request->id]["price"];
                
                $subtotal = 0;
                $cartCount = 0;
                foreach ($cart as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                    $cartCount += $item['quantity'];
                }

                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'item_total' => number_format($itemTotal, 2),
                        'subtotal' => number_format($subtotal, 2),
                        'cart_count' => $cartCount
                    ]);
                }
            }
        }
        
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            if ($request->ajax()) {
                $subtotal = 0;
                $cartCount = 0;
                foreach ($cart as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                    $cartCount += $item['quantity'];
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Ritual removed from your bag.',
                    'subtotal' => number_format($subtotal, 2),
                    'cart_count' => $cartCount,
                    'is_empty' => count($cart) === 0
                ]);
            }

            session()->flash('success', 'Product removed successfully');
        }
        return redirect()->back();
    }
}
