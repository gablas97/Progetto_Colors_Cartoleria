<x-layout>
    <!-- Hero Section -->
    <section class="hero-section bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">Benvenuti nella Cartoleria Online</h1>
                    <p class="lead mb-4">Tutto quello che serve per la scuola e l'ufficio, consegnato direttamente a casa tua.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">Scopri i prodotti</a>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/no-image.jpg') }}" alt="Cartoleria" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>
    <!-- Fine Hero Section -->

    <!-- Sezione Categorie -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Sfoglia per Categoria</h2>
            <div class="row g-4">
                @forelse($categories as $category)
                    <div class="col-md-4 col-lg-3">
                        <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
                            <div class="card h-100 shadow-sm category-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-folder fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center">Nessuna categoria disponibile</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Fine Sezione Categorie -->

    <!-- Sezione Prodotti in evidenza -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Prodotti in Evidenza</h2>
            <div class="row g-4">
                @forelse($featuredProducts as $product)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm product-card">
                            @if($product->primaryImage)
                                <img src="{{ $product->primaryImage->url }}" class="card-img-top" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="No image">
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-muted small">{{ $product->category->name ?? 'Senza categoria' }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($product->compare_price > $product->price)
                                            <span class="text-muted text-decoration-line-through">€{{ number_format($product->compare_price, 2) }}</span>
                                        @endif
                                        <span class="h5 text-primary mb-0">€{{ number_format($product->price, 2) }}</span>
                                    </div>
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Nessun prodotto in evidenza</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Fine Sezione Prodotti in evidenza -->

</x-layout>