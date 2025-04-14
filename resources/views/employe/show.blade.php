@extends('welcome')

@section('title', 'Détails Employé')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Détails de l'Employé #{{ $employe->id }}</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Nom:</strong> {{ $employe->nom }}
                        </li>
                        <li class="list-group-item">
                            <strong>Prénom:</strong> {{ $employe->prenom }}
                        </li>
                        <li class="list-group-item">
                            <strong>Équipe:</strong> {{ $employe->nom_eq ?? 'Non affecté' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
