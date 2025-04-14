
@extends('welcome')

@section('title', 'Liste des Unités de Mesure')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-0">Gestion des Unités de Mesure</h2>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Liste des Unités</h4>
            <a href="{{ route('unite-mesure.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Ajouter
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Symbole</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unites as $unite)
                        <tr>
                            <td>{{ $unite->id_unite }}</td>
                            <td>{{ $unite->symbole }}</td>
                            <td>{{ $unite->nom }}</td>
                            <td>{{ $unite->description ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('unite-mesure.edit', $unite->id_unite) }}"
                                   class="btn btn-sm btn-primary" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('unite-mesure.destroy', $unite->id_unite) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette unité?')"
                                            title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune unité de mesure trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($unites->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $unites->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

