@extends('welcome')

@section('title', 'Modifier Travail d\'Urgence')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h3 class="mb-0">Modifier Travail d'Urgence #{{ $travail->id_travaux }}</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('travaux-urgence.update', $travail->id_travaux) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Colonne de gauche -->
                    <div class="col-md-6">
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="5" required>{{ old('description', $travail->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date du travail -->
                        <div class="mb-3">
                            <label for="datetrv" class="form-label">Date du travail</label>
                            <input type="date" class="form-control @error('datetrv') is-invalid @enderror"
                                   id="datetrv" name="datetrv"
                                   value="{{ old('datetrv', $travail->datetrv ?? now()->format('Y-m-d')) }}" required>
                            @error('datetrv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Colonne de droite -->
                    <div class="col-md-6">
                        <!-- Unité -->
                        <div class="mb-3">
                            <label for="id_up" class="form-label">Unité</label>
                            <select class="form-select @error('id_up') is-invalid @enderror" id="id_up" name="id_up" required>
                                <option value="">Sélectionner une unité</option>
                                @foreach($unites as $unite)
                                    <option value="{{ $unite->id_up }}"
                                        {{ old('id_up', $travail->id_up) == $unite->id_up ? 'selected' : '' }}>
                                        {{ $unite->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_up')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Employé responsable -->
                        <div class="mb-3">
                            <label for="id" class="form-label">Responsable</label>
                            <select class="form-select @error('id') is-invalid @enderror" id="id" name="id" required>
                                <option value="">Sélectionner un employé</option>
                                @foreach($employes as $employe)
                                    <option value="{{ $employe->id }}"
                                        {{ old('id', $travail->id) == $employe->id ? 'selected' : '' }}>
                                        {{ $employe->prenom }} {{ $employe->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- État -->
                        <div class="mb-3">
                            <label for="etat" class="form-label">État</label>
                            <select class="form-select @error('etat') is-invalid @enderror" id="etat" name="etat" required>
                                <option value="en_attente" {{ old('etat', $travail->etat) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ old('etat', $travail->etat) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="termine" {{ old('etat', $travail->etat) == 'termine' ? 'selected' : '' }}>Terminé</option>
                            </select>
                            @error('etat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Commentaires -->
                <div class="mb-3">
                    <label for="commentaires" class="form-label">Commentaires</label>
                    <textarea class="form-control @error('commentaires') is-invalid @enderror"
                              id="commentaires" name="commentaires" rows="3">{{ old('commentaires', $travail->commentaires ?? '') }}</textarea>
                    @error('commentaires')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('travaux-urgence.show', $travail->id_travaux) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
