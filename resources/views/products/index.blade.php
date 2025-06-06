<x-layout>
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar Filtri -->
            <div class="col-lg-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Categorie</h5>
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('products.index', ['categoria' => $category->slug]) }}" 
                                    class="text-decoration-none">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Ordina per</h5>
                        <form method="GET" action="{{ route('products.index') }}">
                            <select name="ordina" class="form-select" onchange="this.form.submit()">
                                <option value="">Più recenti</option>
                                <option value="nome" {{ request('ordina') == 'nome' ? 'selected' : '' }}>Nome</option>
                                <option value="prezzo-asc" {{ request('ordina') == 'prezzo-asc' ? 'selected' : '' }}>Prezzo crescente</option>
                                <option value="prezzo-desc" {{ request('ordina') == 'prezzo-desc' ? 'selected' : '' }}>Prezzo decrescente</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Lista Prodotti -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Tutti i Prodotti</h1>
                    <p class="text-muted mb-0">{{ $products->total() }} prodotti trovati</p>
                </div>

                <div class="row g-4">
                    @forelse($products as $product)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm product-card">
                                @if($product->primaryImage)
                                    <img src="{{ $product->primaryImage->url }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="No image">
                                @endif
                                
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="text-muted small">{{ Str::limit($product->description, 50) }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="h5 text-primary mb-0">€{{ number_format($product->price, 2) }}</span>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary add-to-cart" data-product-id="{{ $product->id }}">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">Nessun prodotto trovato</p>
                        </div>
                    @endforelse
                </div>

                <!-- Paginazione -->
                <div class="mt-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-layout>