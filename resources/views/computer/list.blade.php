@extends('layouts.layout')
@section('title', 'Lista komputerów')

@section('page-heading')Lista komputerów @endsection

@section('content')

<form method="GET">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj: </label>
    </div>
    <div class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="filter" value="{{ $filter }}" placeholder="Imię lub nazwisko">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="computertype" value="{{ $computertype }}" placeholder="Typ">
        </div>
    </div>
    <div class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="brand" value="{{ $brand }}"  placeholder="Marka">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="model" value="{{ $model }}"  placeholder="Model">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="serialnumber" value="{{ $serialnumber }}" placeholder="Numer seryjny">
        </div>
    </div>
    <div class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="ipaddress" value="{{ $ipaddress }}" placeholder="Adres IP">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="macaddress" value="{{ $macaddress }}" placeholder="Adres MAC">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="computername" value="{{ $computername }}" placeholder="Nazwa sieciowa komputera">
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
            <th>Adres IP</th>
            <th>Adres MAC</th>
            <th>Nazwa siec.</th>
            <th>Numer seryjny</th>
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
                    <a href="{{ route('computer.type.edit', ['computerTypeId' => $computer->type_id]) }}">{{ $computer->computerType->type }}</a>
                @else
                    {{ NULL }}
                @endif
            </td>
            <td>{{ $computer->ip_address }}</td>
            <td>{{ $computer->mac_address }}</td>
            <td>{{ $computer->computer_name }}</td>
            <td>{{ $computer->serial_number }}</td>
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
