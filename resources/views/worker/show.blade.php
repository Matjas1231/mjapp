@extends('layouts.layout')

@section('title')Szczegóły pracownika @endsection

@section('page-heading') Szczegóły pracownika {{ $worker->name }} {{ $worker->surname }} @endsection

@section('content')

<div>
    <p>Imię: <b>{{ $worker->name }}</b></p>
    <p>Nazwisko: <b>{{ $worker->surname }}</b></p>
    <p>Stanowisko: <b>{{ $worker->position }}</b></p>
    <p>Dział: <b>{{ $worker->department->name }}</b></p>
    <p>Numer telefonu: <b>{{ $worker->phone }}</b></p>
</div>

<hr>

{{-- Sekcja komputerów --}}
<div>
    <h1 class="h3 mb-0 text-gray-800">Komputery</h1>

    @if (count($worker->computers) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Typ</th>
                    <th>Adres IP</th>
                    <th>Nazwa</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($worker->computers as $computer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $computer->brand }}</td>
                    <td>{{ $computer->model }}</td>
                    <td>{{ $computer->computerType->type }}</td>
                    <td>{{ $computer->ip_address }}</td>
                    <td>{{ $computer->computer_name }}</td>
                    <td>Akcja</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    @else
      Brak komputerów
    @endif

</div>

<hr>

{{-- Sekcja peryferii --}}
<div>
    <h1 class="h3 mb-0 text-gray-800">Peryferia</h1>


    @if (count($worker->peripherals) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Typ</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($worker->peripherals as $peripheral)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peripheral->brand }}</td>
                        <td>{{ $peripheral->model }}</td>
                        <td>{{ $peripheral->peripheralType->type }}</td>
                        <td>Akcja</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        Brak urządzeń peryferyjnych
    @endif

</div>

@endsection
