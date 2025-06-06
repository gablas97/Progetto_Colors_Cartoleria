<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query base per prodotti attivi
        $query = Product::with('primaryImage', 'category')
            ->where('is_active', true);

        // Filtro per categoria se presente
        if ($request->has('categoria')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->categoria);
            });
        }

        // Filtro per ricerca
        if ($request->has('cerca')) {
            $search = $request->cerca;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Ordinamento
        switch ($request->ordina) {
            case 'prezzo-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'prezzo-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'nome':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest(); // Più recenti prima
        }

        // Paginazione
        $products = $query->paginate(12);

        // Categorie per filtro sidebar
        $categories = Category::where('is_active', true)->get();

        return view('products.index', compact('products', 'categories'));
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
    public function show(Product $product)
    {
        // Controlla che il prodotto sia attivo
        if (!$product->is_active) {
            abort(404);
        }

        // Carica relazioni necessarie
        $product->load('images', 'category');

        // Incrementa visualizzazioni
        $product->increment('views');

        // Prodotti correlati (stessa categoria)
        $relatedProducts = Product::with('primaryImage')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
