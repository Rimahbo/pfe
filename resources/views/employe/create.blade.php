@extends('welcome')
@section('title', 'Créer un employee')
@section('content')
<div class="container">
    <h1>Create New Employee</h1>

    <form action="{{ route('employe.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">First Name</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="fonction" class="form-label">Function</label>
            <input type="text" class="form-control" id="fonction" name="fonction" required>
        </div>

        <div class="mb-3">
            <label for="id_eq" class="form-label">Team</label>
            <select class="form-control" id="id_eq" name="id_eq">
                <option value="">-- Select Team --</option>
                @foreach($equipes as $equipe)
                <option value="{{ $equipe->id_eq }}">{{ $equipe->bloc_heure }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mdp" class="form-label">Password</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        </div>
        <!-- Add password confirmation field -->
        <div class="mb-3">
            <label for="mdp_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="mdp_confirmation" name="mdp_confirmation" required>
        </div>

        <!-- Add validation error display -->
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Create Employee</button>
    </form>
</div>
@endsection
