{{-- resources/views/feuille-marche/sections/generateur-turbine.blade.php --}}
<div class="mb-4">
    <h4 class="mb-3">Paramètres Turbine</h4>

    <ul class="nav nav-pills mb-3" id="turbine-heures-tabs" role="tablist">
        @foreach(['8', '12', '16', '20', '0', '4'] as $heure)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                    id="turbine-{{ $heure }}h-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#turbine-{{ $heure }}h"
                    type="button">
                {{ $heure }}h
            </button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content" id="turbine-heures-content">
        @foreach(['8', '12', '16', '20', '0', '4'] as $heure)
        @php
            $paramsHeure = $parametres['turbine'][$heure] ?? collect();
            $getParamValue = function($nom) use ($paramsHeure) {
                return optional($paramsHeure->firstWhere('nom', $nom))->valeur ?? '';
            };
        @endphp

        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
             id="turbine-{{ $heure }}h"
             role="tabpanel">

            <form method="POST"
                  action="{{ route('feuille-marche.store-parametres', $feuille->id_fm) }}">
                @csrf
                <input type="hidden" name="section" value="turbine">
                <input type="hidden" name="heure" value="{{ $heure }}">

                <div class="row g-3">
                    <!-- T. Palier AV Turbine -->
                    <div class="col-md-4">
                        <label class="form-label">T. Palier AV Turbine (°C)</label>
                        <input type="number" class="form-control"
                               name="parametres[T_Palier_AV_Turbine]"
                               value="{{ $getParamValue('T_Palier_AV_Turbine') }}"
                               required>
                    </div>

                    <!-- T. Palier AR Turbine -->
                    <div class="col-md-4">
                        <label class="form-label">T. Palier AR Turbine (°C)</label>
                        <input type="number" class="form-control"
                               name="parametres[T_Palier_AR_Turbine]"
                               value="{{ $getParamValue('T_Palier_AR_Turbine') }}">
                    </div>

                    <!-- Vib Pal Av turbine -->
                    <div class="col-md-4">
                        <label class="form-label">Vib Pal Av turbine (mm)</label>
                        <input type="number" step="0.01" class="form-control"
                               name="parametres[Vib_Pal_Av_turbine]"
                               value="{{ $getParamValue('Vib_Pal_Av_turbine') }}">
                    </div>

                    <!-- Depl axial -->
                    <div class="col-md-4">
                        <label class="form-label">Dépl axial (mm)</label>
                        <input type="number" step="0.01" class="form-control"
                               name="parametres[Depl_axial]"
                               value="{{ $getParamValue('Depl_axial') }}">
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
