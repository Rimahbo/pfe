{{-- resources/views/feuille-marche/sections/generateur-huile.blade.php --}}
<div class="mb-4">
    <h4 class="mb-3">Paramètres Huile</h4>

    <ul class="nav nav-pills mb-3" id="huile-heures-tabs" role="tablist">
        @foreach(['8', '12', '16', '20', '0', '4'] as $heure)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                    id="huile-{{ $heure }}h-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#huile-{{ $heure }}h"
                    type="button">
                {{ $heure }}h
            </button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content" id="huile-heures-content">
        @foreach(['8', '12', '16', '20', '0', '4'] as $heure)
        @php
            $paramsHeure = $parametres['huile'][$heure] ?? collect();
            $getParamValue = function($nom) use ($paramsHeure) {
                return optional($paramsHeure->firstWhere('nom', $nom))->valeur ?? '';
            };
        @endphp

        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
             id="huile-{{ $heure }}h"
             role="tabpanel">

            <form method="POST"
                  action="{{ route('feuille-marche.store-parametres', $feuille->id_fm) }}"
                  class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="section" value="huile">
                <input type="hidden" name="heure" value="{{ $heure }}">

                <div class="row g-3">
                    <!-- P. Refoul pompe -->
                    <div class="col-md-4">
                        <label class="form-label">
                            P. Refoul pompe (bar)
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip"
                               title="Pression de refoulement de la pompe principale - Valeur normale entre 3 et 5 bars"></i>
                        </label>
                        <input type="number" step="0.01" class="form-control"
                               name="parametres[P_Refoul_pompe]"
                               value="{{ $getParamValue('P_Refoul_pompe') }}"
                               required>
                    </div>
                    <!-- Add visual indicators for parameter values outside normal range -->
                    @php
                    $isNormal = $value >= $parametre->valmin && $value <= $parametre->valmax;
                    @endphp
                    <td class="{{ !$isNormal ? 'bg-warning' : '' }}">
                    {{ $value }}
                    @if(!$isNormal)
                    <i class="bi bi-exclamation-triangle text-danger"></i>
                    @endif
                    </td>
                     <script>                   // Validation en temps réel
                    document.querySelectorAll('input[type="number"]').forEach(input => {
                        input.addEventListener('change', function() {
                            const value = parseFloat(this.value);
                            const min = parseFloat(this.min) || 0;
                            const max = parseFloat(this.max) || 100;

                            if (value < min || value > max) {
                                this.classList.add('is-invalid');
                                // Ajouter ici la logique pour afficher l'alerte
                            } else {
                                this.classList.remove('is-invalid');
                                // Cacher l'alerte
                            }
                        });
                    });
                     </script>

                    <div class="col-md-4">
                        <label class="form-label">
                            P. Graissage (bar)
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip"
                               title="Pression du système de graissage - Doit rester stable autour de 2.5 bars"></i>
                        </label>
                        <input type="number" step="0.01" class="form-control"
                               name="parametres[P_Graissage]"
                               value="{{ $getParamValue('P_Graissage') }}"
                               required>
                    </div>

                                        <!-- ΔP. Filtre -->
                    <div class="col-md-4">
                        <label class="form-label">
                            ΔP. Filtre (bar)
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip"
                            title="Différence de pression à travers le filtre à huile - Valeur normale < 0.8 bar. Un ΔP élevé indique un filtre colmaté"></i>
                        </label>
                        <input type="number" step="0.01" class="form-control"
                            name="parametres[DP_Filtre]"
                            value="{{ $getParamValue('DP_Filtre') }}"
                            min="0" max="2">
                    </div>

                    <!-- T. Amont Retri -->
                    <div class="col-md-4">
                        <label class="form-label">
                            T. Amont Retri (°C)
                            <i class="bi bi-info-circle" data-bs-toggle="tooltip"
                            title="Température de l'huile en amont du rétrigérateur - Doit être maintenue entre 45°C et 65°C pour une viscosité optimale"></i>
                        </label>
                        <input type="number" class="form-control"
                            name="parametres[T_Amont_Retri]"
                            value="{{ $getParamValue('T_Amont_Retri') }}"
                            min="30" max="80">
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Enregistrer pour {{ $heure }}h
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
