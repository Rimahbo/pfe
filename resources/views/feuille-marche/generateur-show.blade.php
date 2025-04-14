{{-- resources/views/feuille-marche/generateur-show.blade.php --}}
@extends('welcome')
@section('title', 'Feuille de Marche Générateur #'.$feuille->id_fm)
@section('content')

<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Feuille de Marche Générateur #{{ $feuille->id_fm }}</h3>
        </div>

        <div class="card-body">
            <!-- Onglets pour les différentes sections -->
            <ul class="nav nav-tabs" id="generateurTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="vapeur-tab" data-bs-toggle="tab" data-bs-target="#vapeur" type="button">
                        Vapeur
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="huile-tab" data-bs-toggle="tab" data-bs-target="#huile" type="button">
                        Huile
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="turbine-tab" data-bs-toggle="tab" data-bs-target="#turbine" type="button">
                        Turbine
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="alternateur-tab" data-bs-toggle="tab" data-bs-target="#alternateur" type="button">
                        Alternateur
                    </button>
                </li>
            </ul>

            <!-- Contenu des onglets -->
            <div class="tab-content p-3 border border-top-0 rounded-bottom" id="generateurTabsContent">
                <!-- Section Vapeur -->
                <div class="tab-pane fade show active" id="vapeur" role="tabpanel">
                    @include('feuille-marche.sections.generateur-vapeur')
                </div>

                <!-- Section Huile -->
                <div class="tab-pane fade" id="huile" role="tabpanel">
                    @include('feuille-marche.sections.generateur-huile')
                </div>

                <!-- Section Turbine -->
                <div class="tab-pane fade" id="turbine" role="tabpanel">
                    @include('feuille-marche.sections.generateur-turbine')
                </div>

                <!-- Section Alternateur -->
                <div class="tab-pane fade" id="alternateur" role="tabpanel">
                    @include('feuille-marche.sections.generateur-alternateur')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
