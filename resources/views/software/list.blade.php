@extends('layouts.layout')

@section('title', 'Lista oprogramowania')

@section('page-heading') Lista oprogramowania @endsection

@section('content')

<div class="form-group mb-2">
    <label for="phrase">Wyszukaj: </label>
</div>
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filtername" name="filter" value="{{ $filter }}" placeholder="Imię lub nazwisko">
    </div>
</div>
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterprod" name="producer" value="{{ $producer }}"  placeholder="Producent">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterna" name="name" value="{{ $name }}"  placeholder="Nazwa">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filtersn" name="serialnumber" value="{{ $serialNumber }}"  placeholder="Numer seryjny">
    </div>
</div>

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
    </thead>
    <tbody>
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
                        {{ NULL }}
                    @endif
                </td>
                <td>{{ $software->expiry_date ?? 'N/D' }}</td>
                <td><a href="{{ route('software.show', ['softwareId' => $software->id]) }}">Szczegóły</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="paginateLinks">{{ $softwares->links() }}</div>

<div id="resultdatatable" style="display:none"></div>

@endsection

@section('javascript')
<script>
    searchSoftware("{{ route('software.searchSoftware') }}", {
        worker: "{{ route('worker.show', ['workerId' => ':workerId']) }}",
        details: "{{ route('software.show', ['softwareId' => ':softwareId']) }}"
    });
</script>
@endsection
