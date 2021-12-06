@extends('layouts.layout')

@section('title')Edytowanie komputera @endsection

@section('content')


<form method="POST" action="{{ route('peripheral.update') }}">
    @csrf
    <input type="hidden" id="id" name="id" value="{{ $peripheral->id }}">
    <div class='form-group'>
        <label for="brand">Marka</label>
        <input type="text" class="form-control" id="brand" name="brand" placeholder="Podaj markę" value="{{ $peripheral->brand }}" required>
    </div>
    <div class='form-group'>
        <label for="model">Model</label>
        <input type="text" class="form-control" id="model" name="model" placeholder="Podaj model" value="{{ $peripheral->model }}" required>
    </div>
    <div class='form-group'>
        <label for="serial_number">Numer seryjny</label>
        <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Podaj numer seryjny" value="{{ $peripheral->serial_number }}">
    </div>
        <div class="form-group">
            <label for='type_id'>Typ urządzenia</label>
            <select class='form-control' id='type_id' name='type_id'>
                <option value="{{ NULL }}">Wybierz typ</option>
                @foreach ($types as $type)
                    @if ($peripheral->type_id == $type->id)
                        <option value="{{ $type->id }}" selected>{{ $type->type }}</option>
                    @else
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endif
                @endforeach
            </select>
    </div>
    <div class='form-group'>
        <label for="description">Dodatkowe informacje</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Dodatkowe informacje" value="{{ $peripheral->description }}">
    </div>
    <div class="form-group">
        <label for="worker_id">Pracownik</label>
        <select class='form-control' id='worker_id' name='worker_id'>
            <option value="{{ NULL }}">Wybierz pracownika</option>
            @foreach ($workers as $worker)
                @if ($peripheral->worker_id == $worker->id)
                    <option value="{{ $worker->id }}" selected>{{ $worker->fullname() }}</option>
                @else
                    <option value="{{ $worker->id }}">{{ $worker->fullname() }}</option>
                @endif

            @endforeach
        </select>
    </div>

    <div class='form-group'>
        <label for="date_of_buy">Data zakupu</label>
        <input type="date" class="form-control" id="date_of_buy" name="date_of_buy" placeholder="Podaj datę zakupu" value="{{ $peripheral->date_of_buy }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Zapisz</button>
</form>


@endsection
