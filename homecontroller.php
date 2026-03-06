<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Get all categories (for category carousel)
        $categories = Category::orderBy('id', 'asc')
            ->get();

        // 2. Get trending products (example: most viewed or highest rated)
        $trendingProducts = Product::orderBy('id', 'desc')                      
            ->take(15)
            ->get();

        // 3. Newly arrived products (latest added)
        $newlyArrived = Product::latest()
            ->take(8)
            ->get();

        // 4. Best selling products (example: highest sold count)
        $bestSelling = Product::latest()
            ->take(8)
            ->get();

        // 5. Most popular (example: combination or random for now)
        $mostPopular = Product::inRandomOrder()
            ->take(8)
            ->get();

        // Optional: pass current cart count (if using session cart)
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

        return view('home', compact(
            'categories',
            'trendingProducts',
            'newlyArrived',
            'bestSelling',
            'mostPopular',
            'cartCount'
        ));
    }
}
