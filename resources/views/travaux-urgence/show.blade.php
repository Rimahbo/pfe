@extends('welcome')

@section('title', 'Détails du Travail d\'Urgence')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-danger text-white">
            <h3 class="mb-0">Détails du Travail d'Urgence #{{ $travail->id_travaux }}</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mb-3">Informations de base</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>ID:</strong>
                            <span>{{ $travail->id_travaux }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Date de création:</strong>
                            <span>{{ \Carbon\Carbon::parse($travail->datetrv)->format('d/m/Y H:i') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>État:</strong>
                            <span class="badge bg-{{ $travail->etat === 'termine' ? 'success' : 'warning' }}">
                                {{ ucfirst(str_replace('_', ' ', $travail->etat)) }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h4 class="mb-3">Affectation</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Unité:</strong>
                            <span>
                                @if(isset($travail->unite))
                                    {{ $travail->unite->nom }}
                                @elseif(isset($travail->unite_nom))
                                    {{ $travail->unite_nom }}
                                @else
                                    Non spécifiée
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Responsable:</strong>
                            <span>
                                @if(isset($travail->employe))
                                    {{ $travail->employe->prenom }} {{ $travail->employe->nom }}
                                @else
                                    {{ $travail->employe_prenom ?? '' }} {{ $travail->employe_nom ?? 'Non assigné' }}
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="mb-3">Description</h4>
                    <div class="card">
                        <div class="card-body">
                            {!! nl2br(e($travail->description)) !!}
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($travail->commentaires) && !empty($travail->commentaires))
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="mb-3">Commentaires</h4>
                    <div class="card">
                        <div class="card-body">
                            {!! nl2br(e($travail->commentaires)) !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('travaux-urgence.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <a href="{{ route('travaux-urgence.edit', $travail->id_travaux) }}" class="btn btn-warning me-2">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <form action="{{ route('travaux-urgence.destroy', $travail->id_travaux) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce travail d\'urgence?')">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
