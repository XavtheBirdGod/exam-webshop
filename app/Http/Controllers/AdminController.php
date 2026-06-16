<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        $totalUsers = User::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $allOrders = Order::with('user')->latest()->get();
        $allProducts = Product::orderBy('collection')->get();
        $allUsers = User::latest()->get();
        $lowStockProducts = Product::where('stock', '<', 10)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 
            'totalRevenue', 
            'totalUsers', 
            'recentOrders', 
            'allOrders',
            'allProducts',
            'allUsers',
            'lowStockProducts'
        ));
    }
}
