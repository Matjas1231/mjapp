@extends('layouts.layout')
@section('title')Szczegóły urządzenia @endsection

@section('page-heading')Szczegóły urządzenia @endsection

@section('content')
    <div>
        <p>Marka: <b>{{ $peripheral->brand }}</b></p>
        <p>Model: <b>{{ $peripheral->model }}</b></p>
        <p>Numer seryjny: <b>{{ $peripheral->serial_number ?? 'N/D'}}</b></p>
        <p>Typ: <b>{{ $peripheral->peripheralType->type ?? 'Brak' }}</b></p>
        <p>Dodatkowe informacje: <b>{{ $peripheral->description }}</b></p>
        <p>Pracownik: <b>{{ !is_null($peripheral->worker_id) ? $peripheral->worker->fullname() : 'Brak'}}</b></p>
        <p>Data zakupu: <b>{{ $peripheral->date_of_buy }}</b></p>
        <a href="{{ route('peripheral.edit', ['peripheralId' => $peripheral->id]) }}" class="btn btn-primary">Edytuj</a>
        <a href="{{ route('peripheral.delete', ['peripheralId' => $peripheral->id]) }}" class="btn btn-danger">Usuń</a>
    </div>

@endsection
