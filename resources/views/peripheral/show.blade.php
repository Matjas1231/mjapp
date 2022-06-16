@extends('layouts.layout')
@section('title', 'Szczegóły urządzenia')

@section('page-heading')Szczegóły urządzenia @endsection

@section('content')
    <div>
        <p>Marka: <b>{{ $peripheral->brand }}</b></p>
        <p>Model: <b>{{ $peripheral->model }}</b></p>
        <p>Numer seryjny: <b>{{ $peripheral->serial_number ?? 'N/D'}}</b></p>
        <p>Typ: <b>
            @if (!is_null($peripheral->type_id))
                <a href="{{ route('peripheral.type.edit', ['peripheralTypeId' => $peripheral->type_id]) }}">{{ $peripheral->peripheralType->type }}</a>
            @else
                'Brak'
            @endif </b></p>
        <p>Dodatkowe informacje: <b>{{ $peripheral->description }}</b></p>
        <p>Pracownik: <b>
            @if (!is_null($peripheral->worker_id))
                <a href="{{ route('worker.show', ['workerId' => $peripheral->worker_id]) }}">{{ $peripheral->worker->fullname() }}</a>
            @else
                'Brak pracownika'
            @endif </b></p>
        <p>Adres IP: <b>{{ $peripheral->ip_address }}</b></p>
        <p>Adres MAC: <b>{{ $peripheral->mac_address }}</b></p>
        <p>Nazwa sieciowa: <b>{{ $peripheral->network_name }}</b></p>
        <p>Data zakupu: <b>{{ $peripheral->date_of_buy }}</b></p>
        <a href="{{ route('peripheral.edit', ['peripheralId' => $peripheral->id]) }}" class="btn btn-primary">Edytuj</a>
        <a href="{{ route('peripheral.delete', ['peripheralId' => $peripheral->id]) }}" class="btn btn-danger">Usuń</a>
    </div>

@endsection
