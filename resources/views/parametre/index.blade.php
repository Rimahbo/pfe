@extends('welcome')
@section('title', 'Gestion des Paramètres')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Paramètres de Mesure</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="list-group">
                        @foreach($parametres as $param)
                        <a href="{{ route('parametre.show', $param->id_para) }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $param->titre }}
                            <span class="badge bg-primary rounded-pill">
                                {{ $param->outils_count ?? 0 }} outils                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-8">
                    @if(isset($parametre))
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $parametre->titre }}</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Valeurs:</strong> {{ $parametre->valmin }} à {{ $parametre->valmax }}</p>

                            <h5 class="mt-4">Outils de mesure associés</h5>
                            <ul class="list-group">
                                @foreach($parametre->outils as $outil)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $outil->nom }}
                                    <span class="badge bg-secondary">
                                        {{ $outetre->unite->symbole }}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info">
                        Sélectionnez un paramètre pour voir les détails
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
