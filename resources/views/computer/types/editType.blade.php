@extends('layouts.layout')
@section('title', 'Edycja typu komputera')

@section('page-heading') Edycja {{ $computerType->type }} @endsection



@section('content')


<form method="POST" action="{{ route('computer.type.update')}}">
    <input type="hidden" name="id" value="{{ $computerType->id }}">
    @csrf
    <div class='form-group'>
        <label for="name">Nazwa typu</label>
        <input type="text" class="form-control" id="type" name="type" placeholder="Podaj nazwę typu" value="{{ $computerType->type }}"required>
    </div>
    <button type="submit" class="btn btn-primary">Zapisz</button>
</form>

<div>
    {{-- Sekcja komputerów --}}

    @if (count($computerType->computers) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Adres IP</th>
                    <th>Adres MAC</th>
                    <th>Nazwa siec.</th>
                    <th>Numer seryjny</th>
                    <th>Pracownik</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computers as $computer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $computer->brand }}</td>
                        <td>{{ $computer->model }}</td>
                        <td>{{ $computer->ip_address }}</td>
                        <td>{{ $computer->mac_address }}</td>
                        <td>{{ $computer->network_name }}</td>
                        <td>{{ $computer->serial_number }}</td>
                        <td>
                            @if (!is_null($computer->worker_id))
                                <a href="{{ route('worker.show', ['workerId' => $computer->worker_id]) }}">{{ $computer->worker->fullname() }}</a>
                            @else
                                {{ null }}
                            @endif
                        </td>
                        <td><a href="{{ route('computer.show', ['computerId' => $computer->id]) }}">Szczegóły</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $computers->links() }}
    @else

    @endif
</div>

@endsection
