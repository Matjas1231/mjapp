@extends('layouts.layout')

@section('title', 'Edycja typu urządzenia')

@section('page-heading') Edycja {{ $peripheralType->type }} @endsection

@section('content')

<div>
    <form method="POST" action="{{ route('peripheral.type.update') }}">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $peripheralType->id }}">
        <div class="form-group">
            <input class="form-control" type="text" id="type" name="type" value="{{ $peripheralType->type }}">
        </div>
        <button type="submit" class="btn btn-primary">Edytuj</button>
    </form>
</div>

<div>
    {{-- Sekcja urządzeń --}}

    @if (count($peripheralType->peripherals) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Marka.</th>
                    <th>Model</th>
                    <th>Numer seryjny</th>
                    <th>Adres IP</th>
                    <th>Adres MAC</th>
                    <th>Nazwa siec.</th>
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
                        <td>{{ $peripheral->serial_number }}</td>
                        <td>{{ $peripheral->ip_address }}</td>
                        <td>{{ $peripheral->mac_address }}</td>
                        <td>{{ $peripheral->network_name }}</td>
                        <td>
                            @if (!is_null($peripheral->worker_id))
                                <a href="{{ route('worker.show', ['workerId' => $peripheral->worker_id]) }}">{{ $peripheral->worker->fullname() }}</a>
                            @else
                                ''
                            @endif
                        </td>
                        <td><a href="{{ route('peripheral.show', ['peripheralId' => $peripheral->id]) }}">Szczegóły</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $peripherals->links() }}
    @else
        Brak urządzeń tego typu
    @endif
</div>

@endsection
