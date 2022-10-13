@extends('layouts.layout')
@section('title', 'Lista typów komputerów')

@section('page-heading')
    Lista typów komputerów
    <br>
    <a href="{{ route('computer.type.create') }}"class="btn btn-primary">Dodaj typ</a>
@endsection

@section('content')

<div class="form-inline" id="filterForm">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj: </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterName" placeholder="Nazwa">
    </div>
</div>

<div id="datatable">
    <table class="table table-striped" id="datatable-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($computerTypes as $computerType)
                <tr>
                    <td>{{ $computerType->id }}</td>
                    <td>{{ $computerType->type }}</td>
                    <td>
                            <a href="{{ route('computer.type.edit', ['computerTypeId' => $computerType->id]) }}" class="btn btn-primary">Edycja</a>
                            <a href="{{ route('computer.type.delete', ['computerTypeId' => $computerType->id]) }}" class="btn btn-danger">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="resultdatatable"></div>
</div>

@endsection

@section('javascript')
    <script>
        new Search("{{ route('computer.type.searchComputerType') }}", {
            edit: "{{ route('computer.type.edit', ['computerTypeId' => ':computerTypeId']) }}",
            delete: "{{ route('computer.type.delete', ['computerTypeId' => ':computerTypeId']) }}"
        });
    </script>
@endsection
