@extends('layouts.layout')

@section('title') Lista oprogramowania @endsection

@section('page-heading') Lista oprogramowania @endsection

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <th>Lp.</th>
            <th>Producent</th>
            <th>Numer seryjny</th>
            <th>Pracownik</th>
            <th>Akcja</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($softwares as $software)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $software->producer }}</td>
                <td>{{ $software->serial_number }}</td>
                @if (!is_null($software->worker_id))
                    <td>{{ $software->worker->fullname() }}</td>
                @else
                    <td>
                        {{ NULL }}
                    </td>
                @endif
                <td>Akcja</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
