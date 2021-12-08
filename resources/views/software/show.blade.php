@extends('layouts.layout')

@section('title') Szczegóły oprogramowania @endsection

@section('page-heading') Szczegóły oprogramowania {{ $software->producer }} {{ $software->name }} @endsection

@section('content')

<div>
    <p>Producent: <b>{{ $software->producer }}</b></p>
    <p>Nazwa: <b>{{ $software->name }}</b></p>
    <p>Numer seryjny: <b>{{ $software->serial_number }}</b></p>
    <p>Pracownik: <b>{{ !is_null($software->worker_id) ? $software->worker->fullname() : 'Brak pracownika'}}</b></p>
    <p>Dodatkowe informacje: <b>{{ $software->description }}</b></p>
    <p>Data zakupu: <b>{{ $software->date_of_buy }}</b></p>
    <p>Data ważności: <b>{{ $software->expiry_date ?? 'N/D' }}</b></p>
    <a href="{{ route('software.edit', ['softwareId' => $software->id]) }}" class="btn btn-primary">Edytuj</a>
    <a href="{{ route('software.delete', ['softwareId' => $software->id]) }}" class="btn btn-danger">Usuń</a>
</div>

@endsection
