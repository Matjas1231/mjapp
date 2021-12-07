@extends('layouts.layout')

@section('title')Szczegóły pracownika @endsection

@section('page-heading') Szczegóły pracownika {{ $worker->fullname() }} @endsection

@section('content')

<div>
    <p>Imię: <b>{{ $worker->name }}</b></p>
    <p>Nazwisko: <b>{{ $worker->surname }}</b></p>
    <p>Stanowisko: <b>{{ $worker->position }}</b></p>
    <p>Dział: <b>{{ !is_null($worker->department_id) ? $worker->department->name : 'Nieprzypisany' }}</b></p>
    <p>Numer telefonu: <b>{{ $worker->phone }}</b></p>
    <a href="{{ route('worker.edit', ['workerId' => $worker->id]) }}" class="btn btn-primary"> Edytuj </a>
    <a href="{{ route('worker.delete', ['workerId' => $worker->id]) }}" class="btn btn-danger"> Usuń </a>
</div>

<hr>

{{-- Sekcja oprogramowania --}}
<div>
    <h1 class="h3 mb-0 text-gray-800">Oprogramowanie</h1>

    @if (count($worker->softwares) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Producent</th>
                    <th>Numer Seryjny</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($worker->softwares as $software)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $software->producer }}</td>
                    <td>{{ $software->serial_number }}</td>
                    <td>Akcja</td>
                    {{-- <td><a href="{{ route('computer.edit', ['computerId' => $computer->id]) }}" class="btn btn-primary">Edytuj</a></td> --}}
                </tr>
                @endforeach

            </tbody>
        </table>
    @else
      Brak oprogramowania
    @endif

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
                    <td>{{ !is_null($computer->type_id) ? $computer->computerType->type : NULL }}</td>
                    <td>{{ $computer->ip_address }}</td>
                    <td>{{ $computer->computer_name }}</td>
                    <td><a href="{{ route('computer.edit', ['computerId' => $computer->id]) }}" class="btn btn-primary">Edytuj</a></td>
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
                        <td>{{ !is_null($peripheral->type_id) ? $peripheral->peripheralType->type : NULL }}</td>
                        <td><a href="{{ route('peripheral.edit', ['peripheralId' => $peripheral->id]) }}" class="btn btn-primary">Edytuj</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        Brak urządzeń peryferyjnych
    @endif

</div>

@endsection
