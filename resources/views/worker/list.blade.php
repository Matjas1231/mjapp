@extends('layouts.layout')
@section('title') Lista pracowników @endsection

@section('page-heading')
    Lista pracowników
@endsection

@section('content')


<table class="table table-striped">
    <thead>
        <tr>
                <th>Lp.</th>
                <th>Id.</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Dział</th>
                <th>Telefon</th>
                <th>Akcja</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($workers as $worker)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $worker->id }}</td>
                <td>{{ $worker->name }}</td>
                <td>{{ $worker->surname }}</td>
                @if (!empty($worker->department->name))
                    <td>{{ $worker->department->name }}</td>
                @else
                    <td><b>Nieprzypisany</b></td>
                @endif

                <td>{{ $worker->phone }}</td>
                <td>
                    <a href="{{ route('worker.show', ['workerId' => $worker->id]) }}">Szczegóły</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection
