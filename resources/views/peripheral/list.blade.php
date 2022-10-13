@extends('layouts.layout')

@section('title', 'Lista peryferii')

@section('page-heading')Lista peryferii @endsection

@section('content')

@include('shared.showWithoutWorker')

<div id="datatable">
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
            @include('shared.searchPeripheralAndComputerForm')
        </thead>
        <tbody id="resultdatatable" style="display: none"></tbody>

        <tbody id="datatable-rows">
            @foreach ($peripherals as $peripheral)
                <tr>
                    <td>{{ $peripheral->id }}</td>
                    <td>{{ $peripheral->brand }}</td>
                    <td>{{ $peripheral->model }}</td>
                    <td>
                        @if (!is_null($peripheral->type_id))
                            <a href="{{ route('peripheral.type.edit', ['peripheralTypeId' => $peripheral->type_id]) }}">{{ $peripheral->peripheralType->type }}</a>
                        @else
                            Nieprzypisany typ
                        @endif
                    </td>
                    <td>{{ $peripheral->ip_address }}</td>
                    <td>{{ $peripheral->mac_address }}</td>
                    <td>{{ $peripheral->network_name }}</td>
                    <td>{{ $peripheral->serial_number }}</td>
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
