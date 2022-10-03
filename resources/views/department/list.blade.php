@extends('layouts.layout')
@section('title', 'Lista działów')

@section('page-heading')
    Lista działów
    <br>
    <a href="{{ route('department.create') }}"class="btn btn-primary">Dodaj dział</a>
@endsection

@section('content')
<div class="form-inline" id="filterForm">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj: </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control filter" id="filterdep" placeholder="Nazwa">
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
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('department.edit', ['departmentId' => $department->id]) }}" class="btn btn-primary">Edytuj</a>
                        <a href="{{ route('department.delete', ['departmentId' => $department->id]) }}" class="btn btn-danger">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="resultdatatable"></div>
@endsection

@section('javascript')
    <script>
        searchDepartment("{{ route('department.searchDepartment') }}", "{{ csrf_token() }}");
    </script>
@endsection
