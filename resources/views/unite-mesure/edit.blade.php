

@extends('welcome')

@section('title', 'Modifier Unité de Mesure')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-0">Modifier Unité de Mesure</h2>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulaire de modification</h4>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('unite-mesure.update', $unite->id_unite) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="symbole">Symbole *</label>
                            <input type="text" class="form-control" id="symbole" name="symbole"
                                   value="{{ old('symbole', $unite->symbole) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom complet *</label>
                            <input type="text" class="form-control" id="nom" name="nom"
                                   value="{{ old('nom', $unite->nom) }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"
                              rows="3">{{ old('description', $unite->description) }}</textarea>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('unite-mesure.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
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
