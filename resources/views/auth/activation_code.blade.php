@extends('welcome')
@section('title', 'Account Activation')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center text-dark mb-4" style="font-family: 'Roboto', sans-serif;">Activate Your Account</h1>
            @include('alerte.alerte-message')





            <!-- Card Container -->
            <div class="card shadow-xl border-0 rounded-3 p-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('app_activation_code', ['token' => $token]) }}">
                        @csrf
                        <!-- Activation Code Field -->
                        <div class="mb-3">
                            <label for="activation-code" class="form-label">Activation Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control border-0 shadow-none border-bottom @if(Session::has('danger')) is-invalid @endif" name="activation-code" id="activation-code" placeholder="Enter the code" value="@if(Session::has('activation_code')){{Session::get('activation_code') }} @endif" required>
                                <span class="input-group-text bg-transparent border-0"><i class="bi bi-key"></i></span>
                            </div>
                        </div>

                        <!-- Links to change email or resend code -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <a href="{{route('app_activation_account_change_email', ['token' =>$token])}}" class="text-muted">Change your email address</a>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{route('app_resend_activation_code', ['token' =>$token])}}" class="text-muted">Resend activation code</a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button class="btn btn-gradient btn-lg rounded-5 shadow-lg transition-all" type="submit">
                                Activate Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
