<x-layout>
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Prodotti</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>

        <h1 class="mb-4">{{ $category->name }}</h1>
        
        @if($category->description)
            <p class="lead">{{ $category->description }}</p>
        @endif

        <!-- Sottocategorie -->
        @if($subcategories->count() > 0)
            <div class="row g-3 mb-5">
                @foreach($subcategories as $subcategory)
                    <div class="col-md-4 col-lg-3">
                        <a href="{{ route('categories.show', $subcategory->slug) }}" class="text-decoration-none">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <i class="fas fa-folder fa-2x text-primary mb-2"></i>
                                    <h6>{{ $subcategory->name }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Prodotti -->
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
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
                    <p class="text-center">Nessun prodotto in questa categoria</p>
                </div>
            @endforelse
        </div>

        <!-- Paginazione -->
        <div class="mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-layout>