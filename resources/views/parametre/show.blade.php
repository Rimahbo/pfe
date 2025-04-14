@extends('welcome') {{-- Ou le layout que vous utilisez --}}

@section('title', 'Détails du Paramètre')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Détails du Paramètre: {{ $parametre->titre }}</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Informations de base</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Valeur min:</strong> {{ $parametre->valmin }}
                        </li>
                        <li class="list-group-item">
                            <strong>Valeur max:</strong> {{ $parametre->valmax }}
                        </li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h4>Outils associés</h4>
                    @if($outils->count() > 0)
                        <ul class="list-group">
                            @foreach($outils as $outil)
                                <li class="list-group-item">{{ $outil->nom }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aucun outil associé à ce paramètre</p>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <h4>Valeurs enregistrées</h4>
                @if($valeurs->count() > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Valeur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($valeurs as $valeur)
                            <tr>
                                <td>
                                    @isset($valeur->dateheure)
                                        {{ \Carbon\Carbon::parse($valeur->dateheure)->format('d/m/Y H:i') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($valeur->date_mesure ?? $valeur->created_at ?? now())->format('d/m/Y H:i') }}
                                    @endisset
                                </td>
                                <td>{{ $valeur->valeur ?? $valeur->value ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>Aucune valeur enregistrée pour ce paramètre</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
