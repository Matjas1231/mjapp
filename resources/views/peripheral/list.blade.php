@extends('layouts.layout')

@section('title')Lista peryferii @endsection

@section('page-heading')Lista peryferii @endsection

@section('content')


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Lp.</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Typ</th>
                <th>Numer seryjny</th>
                <th>Pracownik</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peripherals as $peripheral)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peripheral->brand }}</td>
                    <td>{{ $peripheral->model }}</td>
                    <td>
                        @if (!is_null($peripheral->type_id))
                            {{ $peripheral->peripheralType->type }}
                        @else
                            {{ NULL }}
                        @endif
                    </td>
                    <td>{{ $peripheral->serial_number }}</td>
                    <td>
                        @if (!is_null($peripheral->worker_id))
                            <a href="{{ route('worker.show', ['workerId' => $peripheral->worker_id]) }}">{{ $peripheral->worker->fullname() }}</a>
                        @else
                            'Brak pracownika'
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('peripheral.show', ['peripheralId' => $peripheral->id]) }}">Szczegóły</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $peripherals->links() }}

@endsection
