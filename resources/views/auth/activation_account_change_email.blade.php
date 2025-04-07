@extends('welcome')
@section('title', 'Change your email address')
@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-start" style="min-height: 100vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-3 mt-5">
                <div class="card-body">
                    <h2 class="text-center text-muted mb-4">Change your email address</h2>
                    @include('alerte.alerte-message')


                    <form action="{{ route('app_activation_account_change_email', ['token' => $token]) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="new-email" class="form-label">New Email Address</label>
                            <input type="email" class="form-control @if(Session::has('danger')) is-invalid @endif" name="new-email" id="new-email" placeholder="Enter your new email address" value="@if(Session::has('new_email')){{Session::get('new_email') }} @endif" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3">
                                Update Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
