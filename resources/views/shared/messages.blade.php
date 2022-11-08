@if ($message = Session::get('success'))
    <div class="row">
        <div class="alert alert-success col-3" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn align-right" aria-label="Close" data-dismiss="alert">Zamknij</button>
        </div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning" role="alert">
        <button type="button" class="btn-close" aria-label="Close">x</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="btn-close" aria-label="Close">x</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

