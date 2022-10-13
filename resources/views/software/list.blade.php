@extends('layouts.layout')

@section('title', 'Lista oprogramowania')

@section('page-heading') Lista oprogramowania @endsection

@section('content')

<table class="table table-striped table-hover" id="datatable-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producent</th>
            <th>Nazwa</th>
            <th>Numer seryjny</th>
            <th>Pracownik</th>
            <th>Data ważności</th>
            <th>Akcja</th>
        </tr>
        <tr>
            <td class="td-padding">{{-- Blank --}}</td>

            <td class="td-padding">
                <input type="text" class="form-control filter" id="filterProd" name="producer"  placeholder="Producent">
            </td>

            <td class="td-padding">
                <input type="text" class="form-control filter" id="filterNa" name="name" placeholder="Nazwa">
            </td>

            <td class="td-padding">
                <input type="text" class="form-control filter" id="filterSn" name="serialnumber" placeholder="Numer seryjny">
            </td>

            <td class="td-padding">
                <input type="text" class="form-control filter" id="filterName" name="filter" placeholder="Imię lub nazwisko">
            </td>

            <td class="td-padding">{{-- Blank --}}</td>

            <td class="td-padding">{{-- Blank --}}</td>
        </tr>
    </thead>
    <tbody id="resultdatatable" style="display:none"></tbody>

    <tbody id="datatable-rows">
        @foreach ($softwares as $software)
            <tr>
                <td>{{ $software->id }}</td>
                <td>{{ $software->producer }}</td>
                <td>{{ $software->name }}</td>
                <td>{{ $software->serial_number }}</td>
                <td>
                    @if (!is_null($software->worker_id))
                        <a href="{{ route('worker.show', ['workerId' => $software->worker_id]) }}">{{ $software->worker->fullname() }}</a>
                    @else
                        Brak pracownika
                    @endif
                </td>
                <td>{{ $software->expiry_date ?? 'N/D' }}</td>
                <td><a href="{{ route('software.show', ['softwareId' => $software->id]) }}">Szczegóły</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="paginateLinks">{{ $softwares->links() }}</div>

@endsection

@section('javascript')
<script>
    new Search("{{ route('software.searchSoftware') }}", {
        worker: "{{ route('worker.show', ['workerId' => ':workerId']) }}",
        details: "{{ route('software.show', ['softwareId' => ':softwareId']) }}"
    });
</script>
@endsection
