<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('query')) {
            $search = $request->get('query');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('collection', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->category != 'All Rituals') {
            $query->where('category', $request->category);
        }

        if ($request->has('collection')) {
            $query->where('collection', $request->collection);
        }

        // Sorting Logic
        switch ($request->get('sort')) {
            case 'newest':
                $query->latest();
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'recommended':
            default:
                $query->orderBy('popularity', 'desc');
                break;
        }

        $products = $query->get();

        $categories = Product::distinct()->pluck('category')->filter()->values();
        $collections = Product::distinct()->pluck('collection')->filter()->values();

        if ($request->ajax()) {
            return view('pages.shop-products', compact('products'))->render();
        }

        return view('pages.shop', compact('products', 'categories', 'collections'));
    }

    public function show($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        $relatedProducts = Product::where('collection', $product->collection)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }

    public function collections()
    {
        $collections = Product::select('collection', 'category', 'image_url')
            ->distinct()
            ->get()
            ->groupBy('collection');

        return view('pages.collections', compact('collections'));
    }
}
