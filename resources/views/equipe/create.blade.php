@extends('welcome')
@section('title', 'creer une equipe')
@section('content')
<div class="container">
    <h1>Create New Team</h1>

    <form action="{{ route('equipe.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="bloc_heure" class="form-label">Time Block</label>
            <input type="text" class="form-control" id="bloc_heure" name="bloc_heure" required>
        </div>

        <div class="mb-3">
            <label for="id_fm" class="form-label">Worksheet</label>
            <select class="form-control" id="id_fm" name="id_fm" required>
                <option value="">-- Select Worksheet --</option>
                @foreach($feuilles as $feuille)
                <option value="{{ $feuille->id_fm }}">FM#{{ $feuille->id_fm }} ({{ $feuille->date_fm }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Team Members</label>

            <!-- Barre de recherche -->
            <div class="mb-3">
                <input type="text" class="form-control mb-2" id="employeeSearch"
                       placeholder="Search employee by name or function...">
                <small class="text-muted">Type to filter team members</small>
            </div>

            <!-- Liste des employés avec scroll -->
            <div class="border p-3 bg-light" style="max-height: 300px; overflow-y: auto;">
                @foreach($employes as $employe)
                <div class="form-check employee-item mb-2">
                    <input class="form-check-input" type="checkbox" name="employes[]"
                           id="employe_{{ $employe->id }}" value="{{ $employe->id }}">
                    <label class="form-check-label" for="employe_{{ $employe->id }}">
                        <strong>{{ $employe->prenom }} {{ $employe->nom }}</strong>
                        <span class="text-muted">({{ $employe->fonction }})</span>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Team</button>
        <a href="{{ route('equipe.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('employeeSearch');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const employeeItems = document.querySelectorAll('.employee-item');

        employeeItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
@endsection
