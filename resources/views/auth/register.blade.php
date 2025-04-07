@extends('welcome')
@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 mx-auto">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <h3 class="text-center text-dark mb-4">Créer un compte</h3>
                    <p class="text-center text-muted mb-4">Remplissez les informations suivantes pour vous inscrire.</p>

                    <form method="POST" action="{{ route('register') }}" id="form-register">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                            <small class="text-danger fw-bold" id="error-register-nom"></small>
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom') }}" required autocomplete="prenom">
                            <small class="text-danger fw-bold" id="error-register-prenom"></small>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" url-emailExist="{{ route('app_exist_email') }}" token="{{ csrf_token() }}">
                            <small class="text-danger fw-bold" id="error-register-email"></small>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required autocomplete="password">
                            <small class="text-danger fw-bold" id="error-register-password"></small>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirmation du mot de passe</label>
                            <input type="password" name="password-confirm" id="password-confirm" class="form-control" value="{{ old('password-confirm') }}" required autocomplete="password-confirm">
                            <small class="text-danger fw-bold" id="error-register-password-confirm"></small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="agreeTerms" required>
                                <label class="form-check-label" for="agreeTerms">Accepter les termes et conditions</label>
                                <small class="text-danger fw-bold" id="error-register-agreeTerms"></small>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button class="btn btn-primary btn-lg" type="submit" id="register-user">S'inscrire</button>
                        </div>

                        <p class="text-center text-muted">Vous avez déjà un compte ? <a href="{{ route('login') }}">Connectez-vous ici</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
