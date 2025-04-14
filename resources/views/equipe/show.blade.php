@extends('welcome')
@section('title', 'show equipe')
@section('content')
<div class="container">
    <h1>Team Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Team #{{ $equipe->id_eq }}</h5>
            <p class="card-text">
                <strong>Schedule Block:</strong> {{ $equipe->bloc_heure }}<br>
                @if($equipe->id_fm)
                    <strong>Associated Worksheet:</strong> FM#{{ $equipe->id_fm }}
                @endif
            </p>
        </div>
    </div>

    <h2 class="mt-4">Team Members</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Function</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employes as $employe)
            <tr>
                <td>{{ $employe->id }}</td>
                <td>{{ $employe->prenom }} {{ $employe->nom }}</td>
                <td>{{ $employe->email }}</td>
                <td>{{ $employe->fonction }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('equipe.index') }}" class="btn btn-secondary mt-3">
        Back to Teams List
    </a>
</div>
@endsection
