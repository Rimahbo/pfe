@extends('welcome')
@section('title', 'Détails Feuille de Marche #'.$feuille->id_fm)
@section('content')

<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Feuille de Marche #{{ $feuille->id_fm }}</h3>
                <span class="badge bg-light text-dark">
                    {{ \Carbon\Carbon::parse($feuille->date_fm)->format('d/m/Y H:i') }}                </span>
            </div>
        </div>


        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informations</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Type:</strong> {{ $feuille->type_titre }} (v{{ $feuille->type_version }})
                        </li>
                        <li class="list-group-item">
                            <strong>Créée le:</strong>                     {{ \Carbon\Carbon::parse($feuille->date_fm)->format('d/m/Y H:i') }}                </span>

                        </li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Unités concernées</h5>
                    <ul class="list-group">
                        @foreach($unites as $unite)
                        <li class="list-group-item">
                            {{ $unite->nom }} ({{ $unite->localisation ?? 'N/A' }})
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <hr>

            <h4 class="mb-3">Équipes</h4>
            <div class="accordion" id="equipesAccordion">
                @foreach($equipes as $equipe)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $equipe->id_eq }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $equipe->id_eq }}">
                            Équipe #{{ $equipe->id_eq }} - {{ $equipe->bloc_heure }}
                        </button>
                    </h2>
                    <div id="collapse{{ $equipe->id_eq }}" class="accordion-collapse collapse show" data-bs-parent="#equipesAccordion">
                        <div class="accordion-body">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Employé</th>
                                        <th>Fonction</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $equipeEmployes = DB::table('employe')->where('id_eq', $equipe->id_eq)->get();
                                    @endphp
                                    @foreach($equipeEmployes as $employe)
                                    <tr>
                                        <td>{{ $employe->prenom }} {{ $employe->nom }}</td>
                                        <td>{{ $employe->fonction }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-person-lines-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('feuille-marche.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <div>
                    <a href="{{ route('feuille-marche.edit', $feuille->id_fm) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
