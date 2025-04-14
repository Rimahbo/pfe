<div class="mb-4">
    <h4 class="mb-3">Paramètres Vapeur</h4>

    <ul class="nav nav-pills mb-3" id="vapeur-heures-tabs" role="tablist">
        @foreach(['8', '12', '16', '20', '0', '4'] as $heure)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                    id="vapeur-{{ $heure }}h-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#vapeur-{{ $heure }}h"
                    type="button">
                {{ $heure }}h
            </button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content" id="vapeur-heures-content">
        @foreach(['8', '12', '16', '20', '0', '4'] as $heure)
        @php
            $heureParams = $parametres['vapeur'][$heure] ?? collect();
        @endphp

        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
             id="vapeur-{{ $heure }}h"
             role="tabpanel">

            <form method="POST"
                  action="{{ route('feuille-marche.store-parametres', $feuille->id_fm) }}">
                @csrf
                <input type="hidden" name="section" value="vapeur">
                <input type="hidden" name="heure" value="{{ $heure }}">

                <div class="row g-3">
                    <!-- P. Admission -->
                    <div class="col-md-4">
                        <label class="form-label">P. Admission (bar)</label>
                        <input type="text" class="form-control"
                               name="parametres[P_Admission]"
                               value="{{ $heureParams->where('nom', 'P_Admission')->first()->valeur ?? '' }}">
                    </div>

                    <!-- P.Aval roue 1 -->
                    <div class="col-md-4">
                        <label class="form-label">P.Aval roue 1 (bar)</label>
                        <input type="text" class="form-control"
                               name="parametres[P_Aval_roue_1]"
                               value="{{ $heureParams->where('nom', 'P_Aval_roue_1')->first()->valeur ?? '' }}">
                    </div>

                    <!-- P.Soutirage -->
                    <div class="col-md-4">
                        <label class="form-label">P.Soutirage (bar)</label>
                        <input type="text" class="form-control"
                               name="parametres[P_Soutirage]"
                               value="{{ $heureParams->where('nom', 'P_Soutirage')->first()->valeur ?? '' }}">
                    </div>

                    <!-- Ajoutez d'autres champs selon le même modèle -->

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer pour {{ $heure }}h
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
