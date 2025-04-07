@extends('welcome')
@section('title', 'Forgot Password')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mx-auto">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <h3 class="text-center text-dark mb-4">Forgot Password</h3>
                    <p class="text-center text-muted mb-4">Enter your email to receive a password reset link.</p>

                    <form action="{{ route('app_forgot_password') }}" method="POST">
                        @csrf
                        @include('alerte.alerte-message')

                        @error('email')
                        <div class="alert alert-danger mb-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                        </div>
                        @enderror

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button class="btn btn-primary btn-lg" type="submit">Send Reset Link</button>
                        </div>

                        <p class="text-center text-muted">Remember your password? <a href="{{ route('login') }}">Sign In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
