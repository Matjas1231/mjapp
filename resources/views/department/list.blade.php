@extends('layouts.layout')
@section('title', 'Lista działów')

@section('page-heading', 'Lista działów')

@section('content')

<div id="addDepartmentDiv">
    <a class="btn btn-primary mb-1" id="addButton">Dodaj dział</a>
    <div id="saveDepartmentDiv" hidden></div>
    <div id="hiddenDiv" style="width: 225px" class="bg-success text-white show-message hide-in" hidden>Dodano dział</div>
</div>

<div class="form-inline" id="filterForm">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj: </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterDep" placeholder="Nazwa">
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
        <tbody id="resultdatatable"></tbody>
        <tbody id="datatable-rows">
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('department.edit', ['departmentId' => $department->id]) }}" class="btn btn-primary">Edytuj</a>
                        <a class="btn btn-danger deleteButton" data-id={{ $department->id }}>Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('javascript')
    <script>
        const deleteRoute = "{{ route('department.delete', ['departmentId' => ':departmentId']) }}";
        const editRoute = "{{ route('department.edit', ['departmentId' => ':departmentId']) }}"
        const csrfToken = "{{ csrf_token() }}"

        new Search("{{ route('department.searchDepartment') }}", {
            edit: editRoute,
            delete: deleteRoute
        });

        addDepartment("{{ route('department.store') }}", csrfToken, {
            edit: editRoute,
            delete: deleteRoute
        });

        deleteDepartment(deleteRoute);
    </script>
@endsection
