@extends('layouts.layout')

@section('title')Edytowanie komputera @endsection

@section('content')


<form method="POST" action="{{ route('computer.update') }}">
    @csrf
    <input type="hidden" id="id" name="id" value="{{ $computer->id }}">
    <div class='form-group'>
        <label for="brand">Marka</label>
        <input type="text" class="form-control" id="brand" name="brand" placeholder="Podaj markę" value="{{ $computer->brand }}" required>
    </div>
    <div class='form-group'>
        <label for="model">Model</label>
        <input type="text" class="form-control" id="model" name="model" placeholder="Podaj model" value="{{ $computer->model }}" required>
    </div>
    <div class='form-group'>
        <label for="brand">Typ</label>
        <select class="form-control" id="type_id" name="type_id">
            <option value="{{ NULL }}"></option>
            @foreach ($types as $type)
                @if ($type->id == $computer->type_id)
                    <option value="{{ $type->id }}" selected>{{ $type->type }}</option>
                @else
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class='form-group'>
        <label for="processor">Procesor</label>
        <input type="text" class="form-control" id="processor" name="processor" placeholder="Podaj model procesora" value="{{ $computer->processor }}" required>
    </div>
    <div class='form-group'>
        <label for="motherboard">Płyta główna</label>
        <input type="text" class="form-control" id="motherboard" name="motherboard" placeholder="Podaj model płyty głównej" value="{{ $computer->motherboard }}" required>
    </div>
    <div class='form-group'>
        <label for="ram">Pamięć RAM</label>
        <input type="text" class="form-control" id="ram" name="ram" placeholder="Podaj wielkość i rodzaj pamięci" value="{{ $computer->ram }}" required>
    </div>
    <div class='form-group'>
        <label for="description">Dodatkowe informacje</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Podaj dodatkowe informacje" value="{{ $computer->description }}">
    </div>
    <div class='form-group'>
        <label for="worker_id">Wybierz pracownika</label>
        <select class="form-control" id="worker_id" name="worker_id">
            <option value={{ NULL }}></option>
            @foreach ($workers as $worker)
                @if ($worker->id == $computer->worker_id)
                    <option value="{{ $worker->id }}" selected>{{ $worker->name }} {{ $worker->surname }}</option>
                @else
                    <option value="{{ $worker->id }}">{{ $worker->name }} {{ $worker->surname }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class='form-group'>
        <label for="ip_address">Adres IP</label>
        <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="Podaj adres IP" value="{{ $computer->ip_address }}" required>
    </div>
    <div class='form-group'>
        <label for="computer_name">Nazwa komputera</label>
        <input type="text" class="form-control" id="computer_name" name="computer_name" placeholder="Podaj nazwę komputera" value="{{ $computer->computer_name }}" required>
    </div>
    <div class='form-group'>
        <label for="date_of_buy">Data zakupu</label>
        <input type="date" class="form-control" id="date_of_buy" name="date_of_buy" placeholder="Podaj datę zakupu" value="{{ $computer->date_of_buy }}" required>
    </div>
    <button class="btn btn-primary" type="submit">Edytuj</button>
</form>
@endsection
