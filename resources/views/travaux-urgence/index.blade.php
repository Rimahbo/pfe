@extends('welcome')
@section('title', 'Travaux d\'Urgence')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Travaux d'Urgence</h3>
            <a href="{{ route('travaux-urgence.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Nouveau Travail
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Unité</th>
                            <th>État</th>
                            <th>Responsable</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($travaux as $travail)
                        <tr class="@if($travail->etat === 'en_cours') table-warning @endif">
                            <td>{{ $travail->id_travaux }}</td>
                            <td>{{ strlen($travail->description) > 50 ? substr($travail->description, 0, 50).'...' : $travail->description }}</td>
                            <td>
                                @if(isset($travail->unite))
                                    {{ $travail->unite->nom }}
                                @elseif(isset($travail->unite_nom))
                                    {{ $travail->unite_nom }}
                                @else
                                    Non spécifiée
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $travail->etat === 'termine' ? 'success' : 'warning' }}">
                                    {{ ucfirst(str_replace('_', ' ', $travail->etat)) }}
                                </span>
                            </td>
                            <td>
                                @if(isset($travail->employe))
                                    {{ $travail->employe->prenom }} {{ $travail->employe->nom }}
                                @else
                                    {{ $travail->employe_prenom ?? '' }} {{ $travail->employe_nom ?? 'Non assigné' }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('travaux-urgence.show', $travail->id_travaux) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
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
