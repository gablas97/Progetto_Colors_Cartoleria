<x-layout>
    <div class="container py-5">
        <h1 class="mb-4">Il tuo Carrello</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="text-center text-muted py-5">
                            <i class="fas fa-shopping-cart fa-3x mb-3"></i><br>
                            Il tuo carrello è vuoto
                        </p>
                        <div class="text-center">
                            <a href="{{ route('products.index') }}" class="btn btn-primary">
                                Continua lo shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Riepilogo Ordine</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotale:</span>
                            <strong>€0.00</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Spedizione:</span>
                            <strong>Da calcolare</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5">Totale:</span>
                            <strong class="h5">€0.00</strong>
                        </div>
                        <button class="btn btn-primary w-100" disabled>
                            Procedi al checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>