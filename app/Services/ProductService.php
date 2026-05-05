<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductService
{
    public function getShopProducts()
    {
        return Product::latest()->get();
    }

    /**
     * Handle the creation of a new product.
     */
    public function createProduct(array $data)
    {
        $product = Product::create([
            'shop_id' => auth()->user()->shop_id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);

        if (!empty($data['variants'])) {
            foreach ($data['variants'] as $variantData) {
                $product->variants()->create($variantData);
            }
        }

        return $product;
    }

    /**
     * Update an existing product.
     */
    public function updateProduct(Product $product, array $data): bool
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $product->update($data);
    }

    /**
     * Delete a product safely.
     */
    public function deleteProduct(Product $product): bool
    {

        if ($product->orders()->where('status', 'pending')->exists()) {
            throw new Exception("Cannot delete product with pending orders.");
        }

        return $product->delete();
    }
}
