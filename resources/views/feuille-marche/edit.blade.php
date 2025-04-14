@extends('welcome')
@section('title', 'editer la feuille de marche')
@section('content')
<div class="container">
    <h1>Edit Worksheet #{{ $feuille->id_fm }}</h1>

    <form action="{{ route('feuille-marche.update', $feuille->id_fm) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="code_type" class="form-label">Type</label>
            <select class="form-control" id="code_type" name="code_type" required>
                @foreach($types as $type)
                <option value="{{ $type->code_type }}"
                    {{ $type->code_type == $feuille->code_type ? 'selected' : '' }}>
                    {{ $type->titre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_fm" class="form-label">Date</label>
            <input type="date" class="form-control" id="date_fm" name="date_fm"
                   value="{{ old('date_fm', $feuille->date_fm) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Units</label>
            @foreach($unites as $unite)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="unites[]"
                       id="unite_{{ $unite->id_up }}" value="{{ $unite->id_up }}"
                       {{ in_array($unite->id_up, $currentUnites) ? 'checked' : '' }}>
                <label class="form-check-label" for="unite_{{ $unite->id_up }}">
                    {{ $unite->nom }}
                </label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update Worksheet</button>
        <a href="{{ route('feuille-marche.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
