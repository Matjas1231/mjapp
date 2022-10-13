@extends('layouts.layout')

@section('title', 'Edytowanie komputera')
@section('page-heading') Edytowanie komputera {{ $computer->network_name }} @endsection

@section('content')

<form method='POST' action="{{ route('computer.update') }}">
    @csrf
    <input type='hidden' id='id' name='id' value="{{ $computer->id }}">
    <div class='form-row'>
        <div class='col'>
            <label for='brand'>Marka</label>
            <input type='text' class='form-control' id='brand' name='brand' placeholder='Podaj markę' value="{{ $computer->brand }}" required>
        </div>
        <div class='col'>
            <label for='model'>Model</label>
            <input type='text' class='form-control' id='model' name='model' placeholder='Podaj model' value="{{ $computer->model }}" required>
        </div>
        <div class='col'>
            <label for='brand'>Typ</label>
            <select class='form-control' id='type_id' name='type_id'>
                <option value="{{ NULL }}">Wybierz typ</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $type->id == $computer->type_id ? 'selected' : ''}}>{{ $type->type }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class='form-row'>
        <div class='col'>
            <label for='processor'>Procesor</label>
            <input type='text' class='form-control' id='processor' name='processor' value="{{ $computer->processor }}" placeholder='Podaj procesor' required>
        </div>
        <div class='col'>
            <label for='motherboard'>Płyta główna</label>
            <input type='text' class='form-control' id='motherboard' name='motherboard' value="{{ $computer->motherboard }}" placeholder='Podaj płytę główną' required>
        </div>
        <div class='col'>
            <label for='ram'>Pamięć RAM</label>
            <input type='text' class='form-control' id='ram' name='ram' placeholder='Podaj wielkość i rodzaj pamięci' value="{{ $computer->ram }}" required>
        </div>
        <div class='col'>
            <label for='ram'>Numer seryjny</label>
            <input type='text' class='form-control' id='serial_number' name='serial_number' placeholder='Podaj numer seryjny' value="{{ $computer->serial_number }}" required>
        </div>
    </div>

    <div class='form-row'>
        <div class='col'>
            <label for='description'>Dodatkowe informacje</label>
            <input type='text' class='form-control' id='description' name='description' placeholder='Podaj dodatkowe informacje' value="{{ $computer->description }}">
        </div>
        <div class='col'>
            <label for='worker_id'>Pracownik</label>
            <select class='form-control' id='worker_id' name='worker_id'>
                <option value={{ NULL }}>Wybierz pracownika</option>
                @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}" {{ $worker->id == $computer->worker_id ? 'selected' : '' }}>{{ $worker->fullname() }}</option>
                @endforeach
            </select>
        </div>
        <div class='col'>
            <label for='date_of_buy'>Data zakupu</label>
            <input type='date' class='form-control' id='date_of_buy' name='date_of_buy' placeholder='Podaj datę zakupu' value="{{ $computer->date_of_buy }}" required>
        </div>
    </div>

    <div class='form-row'>
        <div class='col'>
            <label for='ip_address'>Adres IP</label>
            <input type='text' class='form-control' id='ip_address' name='ip_address' placeholder='Podaj adres IP' value="{{ $computer->ip_address }}" required>
        </div>
        <div class='col'>
            <label for='ip_address'>Adres MAC</label>
            <input type='text' class='form-control' id='mac_address' name='mac_address' placeholder='Podaj adres MAC' value="{{ $computer->mac_address }}" required>
        </div>
        <div class='col'>
            <label for='network_name'>Nazwa komputera</label>
            <input type='text' class='form-control' id='network_name' name='network_name' placeholder='Podaj nazwę komputera' value="{{ $computer->network_name }}" required>
        </div>
    </div>
    <br>
    <button class='btn btn-primary' type='submit'>Zapisz</button>
</form>

@endsection
