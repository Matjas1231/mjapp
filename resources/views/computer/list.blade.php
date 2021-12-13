@extends('layouts.layout')
@section('title')Lista komputerów @endsection

@section('page-heading')Lista komputerów @endsection

@section('content')


<table class="table table-striped">
    <thead>
        <tr>
            <th>Lp.</th>
            <th>Marka</th>
            <th>Model</th>
            <th>Typ</th>
            <th>Adres IP</th>
            <th>Adres MAC</th>
            <th>Nazwa komputera</th>
            <th>Pracownik</th>
            <th>Akcja</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($computers as $computer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $computer->brand }}</td>
            <td>{{ $computer->model }}</td>
            <td>
                @if (!is_null($computer->type_id))
                    {{ $computer->computerType->type }}
                @else
                    {{ NULL }}
                @endif
            </td>
            <td>{{ $computer->ip_address }}</td>
            <td>{{ $computer->mac_address }}</td>
            <td>{{ $computer->computer_name }}</td>
            <td>
                @if (!is_null($computer->worker_id))
                    <a href="{{ route('worker.show', ['workerId' => $computer->worker_id]) }}">{{ $computer->worker->fullname() }}</a>
                @else
                    'Brak pracownika'
                @endif
            </td>
            <td>
                <a href="{{ route('computer.show', ['computerId' => $computer->id]) }}">Szczegóły</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $computers->links() }}


@endsection
