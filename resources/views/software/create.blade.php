@extends('layouts.layout')
@section('title') Dodawanie oprogramowania @endsection

@section('page-heading') Dodawanie oprogramowania @endsection

@section('content')

<form method='POST' action="{{ route('software.store') }}">
    @csrf
    <div class='form-row'>
        <div class='col'>
            <label for='producer'>Producent</label>
            <input type='text' class='form-control' id='producer' name='producer' placeholder='Podaj producenta' required>
        </div>
        <div class='col'>
            <label for='name'>Nazwa</label>
            <input type='text' class='form-control' id='name' name='name' placeholder='Podaj nazwę' required>
        </div>
        <div class='col'>
            <label for='serial_number'>Numer seryjny</label>
            <input type='text' class='form-control' id='serial_number' name='serial_number' placeholder='Podaj numer seryjny' required>
        </div>
    </div>

    <div class='form-group'>
        <label for='worker_id'>Pracownik</label>
        <select class='form-control' id='worker_id' name='worker_id'>
            <option value="{{ NULL }}">Wybierz pracownika</option>
            @foreach ($workers as $worker)
                <option value="{{ $worker->id }}">{{ $worker->fullname() }}</option>
            @endforeach
        </select>
    </div>

    <div class='form-group'>
        <label for='description'>Dodatkowe informacje</label>
        <input type='text' class='form-control' id='description' name='description' placeholder='Podaj dodatkowe informacje'>
    </div>
    <div class='form-row'>
        <div class='col'>
            <label for='date_of_buy'>Data zakupu</label>
            <input type='date' class='form-control' id='date_of_buy' name='date_of_buy' placeholder='Podaj datę zakupu' required>
        </div>
        <div class='col'>
            <label for='expiry_date'>Data ważności</label>
            <input type='date' class='form-control' id='expiry_date' name='expiry_date' placeholder='Podaj datę ważności'>
        </div>
    </div>
    <br>
    <button class='btn btn-primary' type='submit'>Zapisz</button>
</form>

@endsection
