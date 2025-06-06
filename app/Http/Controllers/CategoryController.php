<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Controlla che la categoria sia attiva
        if (!$category->is_active) {
            abort(404);
        }

        // Prodotti della categoria con paginazione
        $products = $category->products()
            ->with('primaryImage')
            ->where('is_active', true)
            ->paginate(12);

        // Sottocategorie se presenti
        $subcategories = $category->children()
            ->where('is_active', true)
            ->get();

        return view('categories.show', compact('category', 'products', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
