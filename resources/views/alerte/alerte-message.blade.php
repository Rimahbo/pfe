@if (Session::has('success'))
    <div class="alert alert-success mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
            {{ Session::get('success')}}
    </div>

@endif
@if (Session::has('danger'))
    <div class="alert alert-danger mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
            {{ Session::get('danger')}}
    </div>

@endif
@if (Session::has('warning'))
    <div class="alert alert-warning mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
            {{ Session::get('warning')}}
    </div>

@endif
