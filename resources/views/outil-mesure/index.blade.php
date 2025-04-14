@extends('welcome')
@section('title', 'Gestion des Outils de Mesure')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Outils de Mesure</h3>
            <a href="{{ route('outil-mesure.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Nouvel Outil
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Paramètre</th>
                            <th>Unité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($outils as $outil)
                        <tr>
                            <td>{{ $outil->idot }}</td>
                            <td>{{ $outil->nom }}</td>
                            <td>{{ $outil->parametre->titre }}</td>
                            <td>{{ $outil->parametre->unite->symbole }}</td>
                            <td>
                                <a href="{{ route('outil-mesure.show', $outil->idot) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-tools"></i>
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
