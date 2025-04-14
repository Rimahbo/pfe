@extends('welcome')

@section('title', 'Modifier Employé')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Modifier Employé #{{ $employe->id }}</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('employe.update', $employe->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom"
                                   value="{{ old('nom', $employe->nom) }}" required>
                        </div>


                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom"
                                   value="{{ old('prenom', $employe->prenom) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_eq" class="form-label">Équipe</label>

                            <select class="form-select" id="id_eq" name="id_eq">
                                <option value="">Non affecté</option>
                                @foreach($equipes as $equipe)
                                    <option value="{{ $equipe->id_eq }}"
                                        {{ $employe->id_eq == $equipe->id_eq ? 'selected' : '' }}>
                                        {{ $equipe->nom_affiche }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('employe.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
