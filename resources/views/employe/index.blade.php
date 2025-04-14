@extends('welcome')
@section('title', 'Gestion des Employés')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Liste des Employés</h3>
            <a href="{{ route('employe.create') }}" class="btn btn-light">
                <i class="bi bi-person-plus"></i> Nouvel Employé
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Fonction</th>
                            <th>Équipe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employes as $employe)
                        <tr>
                            <td>{{ $employe->id }}</td>
                            <td>{{ $employe->prenom }} {{ $employe->nom }}</td>
                            <td>{{ $employe->email }}</td>
                            <td>{{ $employe->fonction }}</td>
                            <td>
                                @if($employe->id_eq)  <!-- Check if employee has an equipe ID -->
                                Équipe #{{ $employe->id_eq }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('employe.show', $employe->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('employe.edit', $employe->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Add pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $employes->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
