@extends('welcome')
@section('title', 'Liste des Feuilles de Marche')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Feuilles de Marche</h3>
            <a href="{{ route('feuille-marche.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Nouvelle Feuille
            </a>
        </div>

        <div class="card-body">
            @include('alerte.alerte-message')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Unité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feuilles as $feuille)
                        <tr>
                            <td>{{ $feuille->id_fm }}</td>
                            <td>{{ $feuille->date_fm->format('d/m/Y H:i') }}</td>
                            <td>{{ $feuille->type_titre }}</td>  <!-- Utilisez directement type_titre -->
                            <td>
                                @if(!empty($feuille->unites_noms))
                                    {{ $feuille->unites_noms }}
                                @else
                                    Aucune unité
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('feuille-marche.show', $feuille->id_fm) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('feuille-marche.edit', $feuille->id_fm) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
