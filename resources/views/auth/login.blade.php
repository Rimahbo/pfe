@extends('welcome')
@section('title', 'Login')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mx-auto">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <h3 class="text-center text-dark mb-4">Sign In</h3>
                    <p class="text-center text-muted mb-4">Please login to your account</p>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        @include('alerte.alerte-message')

                        @error('email')
                        <div class="alert alert-danger mb-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                        </div>
                        @enderror

                        @error('password')
                        <div class="alert alert-danger mb-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                        </div>
                        @enderror

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password" placeholder="Enter your password">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="#">Forgot password?</a>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button class="btn btn-primary btn-lg" type="submit">Sign In</button>
                        </div>

                        <p class="text-center text-muted">Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
