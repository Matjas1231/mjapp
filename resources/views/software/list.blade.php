@extends('layouts.layout')

@section('title') Lista oprogramowania @endsection

@section('page-heading') Lista oprogramowania @endsection

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <th>Lp.</th>
            <th>Producent</th>
            <th>Nazwa</th>
            <th>Numer seryjny</th>
            <th>Pracownik</th>
            <th>Data ważności</th>
            <th>Akcja</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($softwares as $software)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $software->producer }}</td>
                <td>{{ $software->name }}</td>
                <td>{{ $software->serial_number }}</td>
                <td>
                    @if (!is_null($software->worker_id))
                        <a href="{{ route('worker.show', ['workerId' => $software->worker_id]) }}">{{ $software->worker->fullname() }}</a>
                    @else
                        {{ NULL }}
                    @endif
                </td>
                <td>{{ $software->expiry_date ?? 'N/D' }}</td>
                <td><a href="{{ route('software.show', ['softwareId' => $software->id]) }}">Szczegóły</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
