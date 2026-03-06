<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'asc')->get();

        $trendingProducts = Product::orderBy('id', 'desc')->take(15)->get();
        $newlyArrived = Product::latest()->take(8)->get();
        $bestSelling = Product::latest()->take(8)->get();
        $mostPopular = Product::inRandomOrder()->take(8)->get();

        // FILTERS 
        $query = Product::query();

        if ($request->filled('category_id')) {
            $query->whereIn('category_id', $request->input('category_id'));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('min_rating')) {
            $query->where('rating', '>=', $request->input('min_rating'));
        }

        $products = $query->latest()->paginate(12);

        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

        return view('home', compact(
            'categories',
            'trendingProducts',
            'newlyArrived',
            'bestSelling',
            'mostPopular',
            'products',
            'cartCount'
        ));
    }
}
