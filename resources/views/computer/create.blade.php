@extends('layouts.layout')

@section('title', 'Dodawanie komputera')

@section('page-heading')Dodawanie komputera @endsection

@section('content')


<form method='POST' action="{{ route('computer.store') }}">
    @csrf
    <div class='form-row'>
        <div class='col'>
            <label for='brand'>Marka</label>
            <input type='text' class='form-control' id='brand' name='brand' placeholder='Podaj markę' required>
        </div>
        <div class='col'>
            <label for='model'>Model</label>
            <input type='text' class='form-control' id='model' name='model' placeholder='Podaj model' required>
        </div>
        <div class='col'>
            <label for='brand'>Typ</label>
            <select class='form-control' id='type_id' name='type_id'>
                <option value="{{ NULL }}">Wybierz typ</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class='form-row'>
        <div class='col'>
            <label for='processor'>Procesor</label>
            <input type='text' class='form-control' id='processor' name='processor' placeholder='Podaj procesor' required>
        </div>
        <div class='col'>
            <label for='motherboard'>Płyta główna</label>
            <input type='text' class='form-control' id='motherboard' name='motherboard' placeholder='Podaj płytę główną' required>
        </div>
        <div class='col'>
            <label for='ram'>Pamięć RAM</label>
            <input type='text' class='form-control' id='ram' name='ram' placeholder='Podaj wielkość i rodzaj pamięci' required>
        </div>
        <div class='col'>
            <label for='ram'>Numer seryjny</label>
            <input type='text' class='form-control' id='serial_number' name='serial_number' placeholder='Podaj numer seryjny' required>
        </div>
    </div>

    <div class='form-row'>
        <div class='col'>
            <label for='description'>Dodatkowe informacje</label>
            <input type='text' class='form-control' id='description' name='description' placeholder='Podaj dodatkowe informacje'>
        </div>
        <div class='col'>
            <label for='worker_id'>Pracownik</label>
            <select class='form-control' id='worker_id' name='worker_id'>
                <option value={{ NULL }}>Wybierz pracownika</option>
                @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                @endforeach
            </select>
        </div>
        <div class='col'>
            <label for='date_of_buy'>Data zakupu</label>
            <input type='date' class='form-control' id='date_of_buy' name='date_of_buy' placeholder='Podaj datę zakupu' value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
        </div>
    </div>

    <div class='form-row'>
        <div class='col'>
            <label for='ip_address'>Adres IP</label>
            <input type='text' class='form-control' id='ip_address' name='ip_address' placeholder='Podaj adres IP' value='Dynamic' required>
        </div>
        <div class='col'>
            <label for='ip_address'>Adres MAC</label>
            <input type='text' class='form-control' id='mac_address' name='mac_address' placeholder='Podaj adres MAC' value='00:00:00:00:00:00' required>
        </div>
        <div class='col'>
            <label for='computer_name'>Nazwa komputera</label>
            <input type='text' class='form-control' id='computer_name' name='computer_name' placeholder='Podaj nazwę komputera' required>
        </div>
    </div>
    <br>
    <button class='btn btn-primary' type='submit'>Zapisz</button>
</form>
@endsection
