@extends('layouts.layout')

@section('title', 'Lista peryferii')

@section('page-heading')Lista peryferii @endsection

@section('content')

<form method="GET">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj: </label>
    </div>
    <div class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="filter" placeholder="Imię lub nazwisko" value="{{ $filter }}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="peripheraltype" placeholder="Typ" value="{{ $peripheralType }}">
        </div>
    </div>
    <div class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="brand" placeholder="Marka" value="{{ $brand }}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="model" placeholder="Model" value="{{ $model }}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="serialnumber" placeholder="Numer seryjny" value="{{ $serialNumber }}">
        </div>
    </div>
    <div class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="ipaddress" placeholder="Adres IP" value="{{ $ipaddress }}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="macaddress" placeholder="Adres MAC" value="{{ $macaddress }}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="networkname" placeholder="Nazwa sieciowa urządzenia" value="{{ $networkName }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Szukaj</button>
</form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Lp.</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Typ</th>
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
                    <td>
                        @if (!is_null($peripheral->type_id))
                            <a href="{{ route('peripheral.type.edit', ['peripheralTypeId' => $peripheral->type_id]) }}">{{ $peripheral->peripheralType->type }}</a>
                        @else
                            {{ NULL }}
                        @endif
                    </td>
                    <td>{{ $peripheral->serial_number }}</td>
                    <td>{{ $peripheral->ip_address }}</td>
                    <td>{{ $peripheral->mac_address }}</td>
                    <td>{{ $peripheral->network_name }}</td>
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
