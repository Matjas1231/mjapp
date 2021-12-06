@extends('layouts.layout')
@section('title') Dodawanie urządzenia @endsection

@section('page-heading') Dodawanie urządzenia @endsection

@section('content')

<form method="POST" action="{{ route('peripheral.store') }}">
    @csrf
    <div class='form-group'>
        <label for="brand">Marka</label>
        <input type="text" class="form-control" id="brand" name="brand" placeholder="Podaj markę" required>
    </div>
    <div class='form-group'>
        <label for="model">Model</label>
        <input type="text" class="form-control" id="model" name="model" placeholder="Podaj model" required>
    </div>
    <div class='form-group'>
        <label for="serial_number">Numer seryjny</label>
        <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Podaj numer seryjny"">
    </div>
        <div class="form-group">
            <label for='type_id'>Typ urządzenia</label>
            <select class='form-control' id='type_id' name='type_id'>
                <option value="{{ NULL }}">Wybierz typ</option>
                @foreach ($peripheralTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
    </div>
    <div class='form-group'>
        <label for="description">Dodatkowe informacje</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Dodatkowe informacje">
    </div>
    <div class="form-group">
        <label for="worker_id">Pracownik</label>
        <select class='form-control' id='worker_id' name='worker_id'>
            <option value="{{ NULL }}">Wybierz pracownika</option>
            @foreach ($workers as $worker)
                <option value="{{ $worker->id }}">{{ $worker->fullname() }}</option>
            @endforeach
        </select>
    </div>

    <div class='form-group'>
        <label for="date_of_buy">Data zakupu</label>
        <input type="date" class="form-control" id="date_of_buy" name="date_of_buy" placeholder="Podaj datę zakupu" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Zapisz</button>
</form>

@endsection
