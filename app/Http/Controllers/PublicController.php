<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage()
{
    $featuredProducts = Product::with('primaryImage', 'category')
        ->where('is_active', true)
        ->where('is_featured', true)
        ->limit(8)
        ->get();

    $categories = Category::where('is_active', true)
        ->whereNull('parent_id')
        ->orderBy('sort_order')
        ->get();

    return view('home', compact('featuredProducts', 'categories'));
}
}
