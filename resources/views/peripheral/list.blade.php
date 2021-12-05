@extends('layouts.layout')

@section('title')Lista peryferii @endsection

@section('page-heading')Lista peryferii @endsection

@section('content')


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Lp.</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Typ</th>
                <th>Pracownik</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peripherals as $peripheral)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peripheral->brand }}</td>
                    <td>{{ $peripheral->model }}</td>
                    @if (!is_null($peripheral->type_id))
                        <td>{{ $peripheral->peripheralType->type }}</td>
                    @else
                        <td>{{ NULL }}</td>
                    @endif
                    @if (!is_null($peripheral->worker_id))
                        <td>{{ $peripheral->worker->name }} {{ $peripheral->worker->surname }}</td>
                    @else
                        <td>{{ NULL }}</td>
                    @endif
                    <td>Akcja</td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
