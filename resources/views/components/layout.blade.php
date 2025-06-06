<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('homepage') }}">
                <i class="fas fa-pencil-alt"></i> Colors
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Prodotti</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Categorie
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Penne e Matite</a></li>
                            <li><a class="dropdown-item" href="#">Quaderni</a></li>
                            <li><a class="dropdown-item" href="#">Zaini e Astucci</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('products.index') }}">Tutti i prodotti</a></li>
                        </ul>
                    </li>
                </ul>
                
                <!-- Search -->
                <form class="d-flex me-3" action="{{ route('products.index') }}" method="GET">
                    <input class="form-control me-2" type="search" name="cerca" placeholder="Cerca..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <!-- Cart & User -->
                <div class="d-flex align-items-center">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-primary position-relative me-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
                    </a>
                    
                    @guest
                        <a href="#" class="btn btn-primary">Accedi</a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">I miei ordini</a></li>
                                <li><a class="dropdown-item" href="#">Wishlist</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    {{-- Fine Navbar --}}

    <main class="min-vh-100">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Colors Taranto</h5>
                    <p>Il tuo negozio di fiducia per articoli di cartoleria, materiale scolastico e forniture per ufficio.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5>Link Utili</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Chi siamo</a></li>
                        <li><a href="#" class="text-white-50">Spedizioni e resi</a></li>
                        <li><a href="#" class="text-white-50">Termini e condizioni</a></li>
                        <li><a href="#" class="text-white-50">Privacy policy</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5>Contatti</h5>
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Via Umbria 35, 74121 Taranto</p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i>+39 099 736 4061</p>
                    <p class="mb-0"><i class="fas fa-envelope me-2"></i>colorstarantosrl@gmail.com</p>
                </div>
            </div>
            
            <hr class="my-4 bg-white">
            
            <div class="text-center">
                <p class="mb-0">&copy; 2025 Colors Taranto. Tutti i diritti riservati.</p>
            </div>
        </div>
    </footer>
    {{-- Fine Footer --}}

</body>
</html>