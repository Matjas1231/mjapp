@extends('layouts.layout')
@section('title', 'Lista typów komputerów')

@section('page-heading')
    Lista typów komputerów
    <br>
    <a href="{{ route('computer.type.create') }}"class="btn btn-primary">Dodaj typ</a>
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
        @foreach ($computerTypes as $computerType)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $computerType->type }}</td>
                <td>
                        <a href="{{ route('computer.type.edit', ['computerTypeId' => $computerType->id]) }}" class="btn btn-primary">Edycja</a>
                        <a href="{{ route('computer.type.delete', ['computerTypeId' => $computerType->id]) }}" class="btn btn-danger">Usuń</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection
