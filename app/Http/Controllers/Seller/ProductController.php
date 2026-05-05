<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        // Dankzij de Global Scope zie je hier alleen de eigen producten
        $products = $this->productService->getShopProducts();
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        return view('seller.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'variants' => 'nullable|array',
            'variants.*.type' => 'required|string',
            'variants.*.value' => 'required|string',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        $this->productService->createProduct($validated);

        return redirect()->route('seller.products.index')
            ->with('success', 'Product met varianten succesvol toegevoegd!');
    }
}
