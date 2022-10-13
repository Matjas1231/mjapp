@extends('layouts.layout')

@section('title', 'Lista pracowników')

@section('page-heading') Lista pracowników @endsection


@section('content')

<div class="form-inline">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj: </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterName" placeholder="Imię lub nazwisko">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterDep" placeholder="Dział">
    </div>
</div>

<div id="datatable">
    <table class="table table-striped table-hover" id="datatable-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Dział</th>
                <th>Telefon</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody id="resultdatatable" style="display:none"></tbody>

        <tbody id="datatable-rows">
            @foreach ($workers as $worker)
                <tr>
                    <td>{{ $worker->id }}</td>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $worker->surname }}</td>
                    <td>
                        @if (!is_null($worker->department_id))
                            <a href="{{ route('department.edit', ['departmentId' => $worker->department_id]) }}">{{ $worker->department->name }}</a>
                        @else
                            Brak pracownika
                        @endif
                    </td>
                    <td>{{ $worker->phone }}</td>
                    <td>
                        <a href="{{ route('worker.show', ['workerId' => $worker->id]) }}">Sczegóły</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="paginateLinks">{{ $workers->links() }}</div>
</div>

@endsection

@section('javascript')
<script>
    new Search("{{ route('worker.searchWorker') }}", {
            details: "{{ route('worker.show', ['workerId' => ':workerId']) }}",
        });
</script>
@endsection
