@extends('welcome')
@section('title', 'Gestion des Équipes')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Liste des Équipes</h3>
            <a href="{{ route('equipe.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Nouvelle Équipe
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bloc Horaire</th>
                            <th>Feuille de Marche</th>
                            <th>Membres</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipes as $equipe)
                        <tr>
                            <td>{{ $equipe->id_eq }}</td>
                            <td>{{ $equipe->bloc_heure }}</td>
                            <td>
                                @if($equipe->id_fm)  <!-- Check if team has a feuille de marche ID -->
                                FM#{{ $equipe->id_fm }}
                                @endif
                            </td>
                            <td>{{ $equipe->employes_count }}</td>                            <td>
                                <a href="{{ route('equipe.show', $equipe->id_eq) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-people-fill"></i>
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
