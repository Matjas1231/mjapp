@extends('layouts.layout')
@section('title')Szczegóły komputera @endsection

@section('page-heading')Szczegóły komputera {{ $computer->computer_name }} @endsection

@section('content')
    <div>
        <p>Marka: <b>{{ $computer->brand }}</b></p>
        <p>Model: <b>{{ $computer->model }}</b></p>
        @if (!empty($computer->type_id))
            <b><td>{{ $computer->computerType->type }}</td></b>
        @else
            <td>Typ: <b>Brak</b></td>
        @endif
        <p>Procesor: <b>{{ $computer->processor }}</b></p>
        <p>Płyta główna: <b>{{ $computer->motherboard }}</b></p>
        <p>RAM: <b>{{ $computer->ram }}</b></p>
        <p>Opis: <b>{{ $computer->description }}</b></p>
        <p>Adres IP: <b>{{ $computer->ip_address }}</b></p>
        <p>Nazwa: <b>{{ $computer->computer_name }}</b></p>
        <p>Data zakupu: <b>{{ $computer->date_of_buy }}</b></p>

        <p>Pracownik:
            @if(empty($computer->worker->name))
                <b>Brak pracownika</b>
            @else
                <b>{{ $computer->worker->name }} {{ $computer->worker->surname }}</b>
            @endif

        </p>
    </div>

@endsection
