@extends('layouts.layout')
@section('title', 'Lista działów')

@section('page-heading', 'Lista działów')

@section('content')

@include('shared.messages')

@include('shared.simpleAdd', ['route' => route('department.store'), 'name' => 'dział'])

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
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('department.edit', ['departmentId' => $department->id]) }}" class="btn btn-primary">Edytuj</a>
                        <a class="btn btn-danger deleteButton" href="{{ route("department.delete", ['departmentId' => $department->id]) }}">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('javascript')
    <script>
        new Search("{{ route('department.searchDepartment') }}", {
            edit: "{{ route('department.edit', ['departmentId' => ':departmentId']) }}",
            delete: "{{ route('department.delete', ['departmentId' => ':departmentId']) }}"
        });
    </script>
@endsection
