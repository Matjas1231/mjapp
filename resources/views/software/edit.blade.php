@extends('layouts.layout')

@section('title', 'Edytowanie oprogramowania')

@section('page-heading') Edytowanie oprogramowania {{ $software->producer }} {{ $software->name }} @endsection

@section('content')

<form method="POST" action="{{ route('software.update') }}">
    @csrf
    <input type="hidden" value="{{ $software->id }}" id="id" name="id">
    <div class='form-group'>
        <label for="producer">Producent</label>
        <input type="text" class="form-control" id="producer" name="producer" placeholder="Podaj producenta" value="{{ $software->producer }}" required>
    </div>
    <div class='form-group'>
        <label for="serial_number">Numer seryjny</label>
        <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Podaj numer seryjny" value="{{ $software->serial_number }}" required>
    </div>
    <div class='form-group'>
        <label for="name">Nazwa</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Podaj nazwę" value="{{ $software->name }}" required>
    </div>

    <div class="form-group">
        <label for='worker_id'>Pracownik</label>
        <select class='form-control' id='worker_id' name='worker_id'>
            <option value="{{ NULL }}">Wybierz pracownika</option>
            @foreach ($workers as $worker)
                <option value="{{ $worker->id }}" {{ $worker->id == $software->worker_id ? 'selected' : ''}}>{{ $worker->fullname() }}</option>
            @endforeach
        </select>
    </div>

    <div class='form-group'>
        <label for="description">Dodatkowe informacje</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Podaj dodatkowe informacje" value="{{ $software->description }}">
    </div>
    <div class='form-group'>
        <label for="date_of_buy">Data zakupu</label>
        <input type="date" class="form-control" id="date_of_buy" name="date_of_buy" placeholder="Podaj datę zakupu" value="{{ $software->date_of_buy }}" required>
    </div>
    <div class='form-group'>
        <label for="expiry_date">Data ważności</label>
        <input type="date" class="form-control" id="expiry_date" name="expiry_date" placeholder="Podaj datę ważności" value="{{ $software->expiry_date }}">
    </div>

    <button class="btn btn-primary" type="submit">Zapisz</button>
</form>

@endsection
