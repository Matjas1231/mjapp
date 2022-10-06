@extends('layouts.layout')
@section('title', 'Lista komputerów')

@section('page-heading')Lista komputerów @endsection

@section('content')

<div class="form-group mb-2">
    <label for="phrase">Wyszukaj: </label>
</div>
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" name="filter" id="filtername" value="{{ $filter }}" placeholder="Imię lub nazwisko">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" name="computertype" id="filtercomputertype" value="{{ $computertype }}" placeholder="Typ">
    </div>
</div>
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" name="brand" id="filterbrand" value="{{ $brand }}"  placeholder="Marka">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" name="model" id="filtermodel" value="{{ $model }}"  placeholder="Model">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" name="serialnumber" id="filterserialnumber" value="{{ $serialnumber }}" placeholder="Numer seryjny">
    </div>
</div>
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" name="ipaddress" id="filteripaddress" value="{{ $ipaddress }}" placeholder="Adres IP">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" name="macaddress" id="filtermacaddress" value="{{ $macaddress }}" placeholder="Adres MAC">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" name="computername" id="filtercomputername" value="{{ $computername }}" placeholder="Nazwa sieciowa komputera">
    </div>
</div>

<table class="table table-striped" id="datatable-table">
    <thead>
        <tr>
            <th>ID</th>
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
            <td>{{ $computer->id }}</td>
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
<div id="paginateLinks">{{ $computers->links() }}</div>

<div id="resultdatatable" style="display:none"></div>

@endsection

@section('javascript')
    <script>
        searchComputer("{{ route('computer.searchComputer') }}", {
            worker: "{{ route('worker.show', ['workerId' => ':workerId']) }}",
            details: "{{ route('computer.show', ['computerId' => ':computerId']) }}"
        });
    </script>
@endsection
