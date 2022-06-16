@extends('layouts.layout')

@section('title', 'Lista typów urządzeń')

@section('page-heading')
    Lista typów urządzeń
    <br>
    <a href="{{ route('peripheral.type.create') }}" class="btn btn-primary">Dodaj</a>
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
            @foreach ($peripheralTypes as $type)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $type->type }}</td>
                    <td>
                        <a href="{{ route('peripheral.type.edit', ['peripheralTypeId' => $type->id]) }}" class="btn btn-primary">Edytuj</a>
                        <a href="{{ route('peripheral.type.delete', ['peripheralTypeId' => $type->id]) }}" class="btn btn-danger">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
