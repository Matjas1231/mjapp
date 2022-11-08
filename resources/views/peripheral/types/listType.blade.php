@extends('layouts.layout')

@section('title', 'Lista typów urządzeń')

@section('page-heading', 'Lista typów urządzeń')

@section('content')

@include('shared.messages')
@include('shared.simpleAdd', ['route' => route('peripheral.type.store'), 'name' => 'typ urządzenia'])

@include('shared.simpleSearch')

<div id="datatable">
    <table class="table table-striped" id="datatable-table">
        <thead>
            <tr>
                <th>Lp.</th>
                <th>Nazwa</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody id="resultdatatable" style="display: none;"></tbody>
        <tbody id="datatable-rows">
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
</div>

@endsection

@section('javascript')
    <script>
        new Search("{{ route('peripheral.type.searchPeripheralType') }}", {
            edit: "{{ route('peripheral.type.edit', ['peripheralTypeId' => ':peripheralTypeId']) }}",
            delete: "{{ route('peripheral.type.delete', ['peripheralTypeId' => ':peripheralTypeId']) }}"
        });
    </script>
@endsection
