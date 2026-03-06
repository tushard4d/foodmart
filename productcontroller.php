<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class productcontroller extends Controller
{
    public function get(request $request)
    {
        $filters = $request->only(['category_id', 'min_price' , 'max_price' , 'ratings']);

        $products = product::filter($filters)
        ->latest()
        ->paginate();

        $categories = product::distinct()->pluck('category_id')->filter()->values();

        return view('home',compact('products','category_id'));
    }
}
