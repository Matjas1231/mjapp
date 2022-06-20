@if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        {{-- <button type="button" class="btn-close" aria-label="Close">x</button> --}}
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning" role="alert">
        {{-- <button type="button" class="btn-close" aria-label="Close">x</button> --}}
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        {{-- <button type="button" class="btn-close" aria-label="Close">x</button> --}}
        <strong>{{ $message }}</strong>
    </div>
@endif
