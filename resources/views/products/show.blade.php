<x-layout>
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Prodotti</a></li>
                @if($product->category)
                    <li class="breadcrumb-item"><a href="{{ route('categories.show', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Immagini Prodotto -->
            <div class="col-lg-6">
                <div class="product-images">
                    @if($product->images->count() > 0)
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($product->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $image->url }}" class="d-block w-100" alt="{{ $image->alt_text }}">
                                    </div>
                                @endforeach
                            </div>
                            @if($product->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" class="img-fluid" alt="No image">
                    @endif
                </div>
            </div>

            <!-- Info Prodotto -->
            <div class="col-lg-6">
                <h1 class="mb-3">{{ $product->name }}</h1>
                
                <div class="mb-3">
                    @if($product->compare_price > $product->price)
                        <span class="text-muted text-decoration-line-through h5">€{{ number_format($product->compare_price, 2) }}</span>
                        <span class="badge bg-danger ms-2">-{{ $product->discount_percentage }}%</span>
                    @endif
                    <div class="h3 text-primary">€{{ number_format($product->price, 2) }}</div>
                </div>

                <div class="mb-4">
                    <p>{{ $product->short_description }}</p>
                </div>

                <!-- Stock Status -->
                <div class="mb-4">
                    @if($product->isInStock())
                        <span class="badge bg-success">Disponibile</span>
                        <small class="text-muted">({{ $product->stock_quantity }} pezzi)</small>
                    @else
                        <span class="badge bg-danger">Non disponibile</span>
                    @endif
                </div>

                <!-- Add to Cart -->
                <form class="mb-4" id="add-to-cart-form">
                    <div class="row g-3">
                        <div class="col-auto">
                            <input type="number" class="form-control" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" style="width: 80px;">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary" {{ !$product->isInStock() ? 'disabled' : '' }}>
                                <i class="fas fa-cart-plus me-2"></i>Aggiungi al Carrello
                            </button>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-outline-secondary add-to-wishlist" data-product-id="{{ $product->id }}">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Product Details -->
                <div class="product-details">
                    <h5>Dettagli prodotto</h5>
                    <table class="table table-sm">
                        <tr>
                            <td>SKU:</td>
                            <td>{{ $product->sku }}</td>
                        </tr>
                        @if($product->category)
                            <tr>
                                <td>Categoria:</td>
                                <td><a href="{{ route('categories.show', $product->category->slug) }}">{{ $product->category->name }}</a></td>
                            </tr>
                        @endif
                        @if($product->weight)
                            <tr>
                                <td>Peso:</td>
                                <td>{{ $product->weight }} kg</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <!-- Descrizione completa -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#description">Descrizione</a>
                    </li>
                </ul>
                
                <div class="tab-content p-3 border border-top-0">
                    <div id="description" class="tab-pane fade show active">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Prodotti correlati -->
        @if($relatedProducts->count() > 0)
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="mb-4">Prodotti correlati</h3>
                    <div class="row g-4">
                        @foreach($relatedProducts as $related)
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 shadow-sm">
                                    @if($related->primaryImage)
                                        <img src="{{ $related->primaryImage->url }}" class="card-img-top" alt="{{ $related->name }}">
                                    @else
                                        <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="No image">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $related->name }}</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 text-primary mb-0">€{{ number_format($related->price, 2) }}</span>
                                            <a href="{{ route('products.show', $related->slug) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout>