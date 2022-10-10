@extends('layouts.layout')

@section('title', 'Lista peryferii')

@section('page-heading')Lista peryferii @endsection

@section('content')

<div class="form-group mb-2">
    <label for="phrase">Wyszukaj: </label>
</div>
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterName" name="filter" placeholder="Imię lub nazwisko">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterPeripheralType" name="peripheraltype" placeholder="Typ">
    </div>
</div>
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterBrand" name="brand" placeholder="Marka">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterModel" name="model" placeholder="Model">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterSn" name="serialnumber" placeholder="Numer seryjny">
    </div>
</div>
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterIpAddress" name="ipaddress" placeholder="Adres IP">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterMacAddress" name="macaddress" placeholder="Adres MAC">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterNetworkName" name="networkname" placeholder="Nazwa sieciowa urządzenia">
    </div>
</div>

<div id="datatable">
    <table class="table table-striped" id="datatable-table">
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
        <tbody id="datatable-rows">
            @foreach ($peripherals as $peripheral)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peripheral->brand }}</td>
                    <td>{{ $peripheral->model }}</td>
                    <td>
                        @if (!is_null($peripheral->type_id))
                            <a href="{{ route('peripheral.type.edit', ['peripheralTypeId' => $peripheral->type_id]) }}">{{ $peripheral->peripheralType->type }}</a>
                        @else
                            Nieprzypisany typ
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
                            Brak pracownika
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('peripheral.show', ['peripheralId' => $peripheral->id]) }}">Szczegóły</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <div id="paginateLinks">{{ $peripherals->links() }}</div>

    <div id="resultdatatable" style="display:none"></div>
@endsection

@section('javascript')
    <script>
        new Search("{{ route('peripheral.searchPeripheral') }}", {
            type: "{{ route('peripheral.type.edit', ['peripheralTypeId' => ':peripheralTypeId']) }}",
            worker: "{{ route('worker.show', ['workerId' => ':workerId']) }}",
            details: "{{ route('peripheral.show', ['peripheralId' => ':peripheralId']) }}"
        });
    </script>
@endsection
