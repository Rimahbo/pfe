@extends('welcome')
@section('title', 'Rapports')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Rapports</h3>
        </div>

        <div class="card-body">
            <div class="list-group">
                @foreach($rapports as $rapport)
                <a href="{{ route('rapport.show', $rapport->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $rapport->titre }}</h5>
                        <small>{{ $rapport->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">Feuille de marche #{{ $rapport->feuille_marche_id }}</p>
                    <small>Généré par {{ $rapport->user->name }}</small>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
