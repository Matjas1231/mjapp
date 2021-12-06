@extends('layouts.layout')

@section('title') Edycja typu komputera @endsection

@section('page-heading') Edycja {{ $peripheralType->type }} @endsection

@section('content')

<div>
    <form method="POST" action="{{ route('peripheral.type.update') }}">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $peripheralType->id }}">
        <div class="form-group">
            <input class="form-control" type="text" id="type" name="type" value="{{ $peripheralType->type }}">
        </div>
        <button type="submit" class="btn btn-primary">Edytuj</button>
    </form>
</div>

<div>
    {{-- Sekcja urządzeń --}}

    @if (count($peripheralType->peripherals) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Marka.</th>
                    <th>Model</th>
                    <th>Pracownik</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peripheralType->peripherals as $peripheral)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peripheral->brand }}</td>
                        <td>{{ $peripheral->model }}</td>
                        <td>{{ !is_null($peripheral->worker_id) ? $peripheral->worker->fullname() : '' }}</td>
                        <td><a href="{{ route('peripheral.edit', ['peripheralId' => $peripheral->id]) }}" class="btn btn-primary">Edytuj</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        Brak urządzeń tego typu
    @endif
</div>

@endsection
