@extends('welcome')
@section('title', 'Gestion des Unités de Production')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Unités de Production</h3>
            <a href="{{ route('unite.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Nouvelle Unité
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                @foreach($unites as $unite)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">{{ $unite->nom }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <i class="bi bi-geo-alt"></i> {{ $unite->localisation }}
                            </p>
                            <p class="card-text">
                                <span class="badge bg-primary">
                                    {{ $unite->feuilles->count() }} feuilles de marche
                                </span>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('unite.show', $unite->id_up) }}" class="btn btn-sm btn-outline-primary">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
