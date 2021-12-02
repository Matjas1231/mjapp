@extends('layouts.layout')
@section('title')Edycja typu komputera @endsection

@section('page-heading') Edycja typu komputera @endsection



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
                    <th>Nazwa</th>
                    <th>Pracownik</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computerType->computers as $computer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $computer->computer_name }}</td>
                        <td>{{ $computer->worker->name }} {{ $computer->worker->surname }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else

    @endif
</div>

@endsection
