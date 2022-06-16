@extends('layouts.layout')
@section('title', 'Lista działów')

@section('page-heading')
    Lista działów
    <br>
    <a href="{{ route('department.create') }}"class="btn btn-primary">Dodaj dział</a>
@endsection

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Lp.</th>
                <th>Nazwa</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('department.edit', ['departmentId' => $department->id]) }}" class="btn btn-primary">Edytuj</a>
                        <a href="{{ route('department.delete', ['departmentId' => $department->id]) }}" class="btn btn-danger">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
