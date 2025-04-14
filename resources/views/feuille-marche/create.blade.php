@extends('welcome')
@section('title', 'Créer une Feuille de Marche')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Nouvelle Feuille de Marche</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('feuille-marche.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="code_type" class="form-label">Type de Feuille</label>
                            <select class="form-select" id="code_type" name="code_type" required>
                                @foreach($types as $type)
                                <option value="{{ $type->code_type }}">{{ $type->titre }} (v{{ $type->version }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date_fm" class="form-label">Date</label>
                            <input type="datetime-local" class="form-control" id="date_fm" name="date_fm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Unités concernées</label>
                            <div class="row">
                                @foreach($unites as $unite)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="unites[]" value="{{ $unite->id_up }}" id="unite_{{ $unite->id_up }}">
                                        <label class="form-check-label" for="unite_{{ $unite->id_up }}">
                                            {{ $unite->nom }} ({{ $unite->localisation }})
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
