{{-- resources/views/feuille-marche/sections/generateur-alternateur.blade.php --}}
<div class="mb-4">
    <h4 class="mb-3">Paramètres Alternateur</h4>

    <ul class="nav nav-pills mb-3" id="alternateur-heures-tabs" role="tablist">
        @foreach(['8', '12', '16', '20', '0', '4'] as $heure)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                    id="alternateur-{{ $heure }}h-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#alternateur-{{ $heure }}h"
                    type="button">
                {{ $heure }}h
            </button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content" id="alternateur-heures-content">
        @foreach(['8', '12', '16', '20', '0', '4'] as $heure)
        @php
            $paramsHeure = $parametres['alternateur'][$heure] ?? collect();
            $getParamValue = function($nom) use ($paramsHeure) {
                return optional($paramsHeure->firstWhere('nom', $nom))->valeur ?? '';
            };
        @endphp

        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
             id="alternateur-{{ $heure }}h"
             role="tabpanel">

            <form method="POST"
                  action="{{ route('feuille-marche.store-parametres', $feuille->id_fm) }}">
                @csrf
                <input type="hidden" name="section" value="alternateur">
                <input type="hidden" name="heure" value="{{ $heure }}">

                <div class="row g-3">
                    <!-- I. Excitation -->
                    <div class="col-md-4">
                        <label class="form-label">I. Excitation (A)</label>
                        <input type="number" step="0.01" class="form-control"
                               name="parametres[I_Excitation]"
                               value="{{ $getParamValue('I_Excitation') }}"
                               required>
                    </div>

                    <!-- U. Excitation -->
                    <div class="col-md-4">
                        <label class="form-label">U. Excitation (V)</label>
                        <input type="number" step="0.01" class="form-control"
                               name="parametres[U_Excitation]"
                               value="{{ $getParamValue('U_Excitation') }}">
                    </div>

                    <!-- P. Active -->
                    <div class="col-md-4">
                        <label class="form-label">P. Active (MW)</label>
                        <input type="number" step="0.01" class="form-control"
                               name="parametres[P_Active]"
                               value="{{ $getParamValue('P_Active') }}">
                    </div>

                    <!-- P. Reactive -->
                    <div class="col-md-4">
                        <label class="form-label">P. Reactive (mvar)</label>
                        <input type="number" step="0.01" class="form-control"
                               name="parametres[P_Reactive]"
                               value="{{ $getParamValue('P_Reactive') }}">
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
