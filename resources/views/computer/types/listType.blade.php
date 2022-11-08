@extends('layouts.layout')
@section('title', 'Lista typów komputerów')

@section('page-heading', 'Lista typów komputerów')

@section('content')

@include('shared.messages')
@include('shared.simpleAdd', ['route' => route('computer.type.store'), 'name' => 'typ komputera'])

@include('shared.simpleSearch')

<div id="datatable">
    <table class="table table-striped" id="datatable-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody id="resultdatatable" style="display: none;"></tbody>

        <tbody id="datatable-rows">
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
