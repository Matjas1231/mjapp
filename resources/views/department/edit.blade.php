@extends('layouts.layout')
@section('title', 'Edycja działu')

@section('page-heading')Edycja działu @endsection

@section('content')

<form method="POST" action="{{ route('department.update')}}">
    <input type="hidden" name="id" value="{{ $department->id }}">
    @csrf
    <div class='form-group'>
        <label for="name">Nazwa działu</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Podaj nazwę działu" value="{{ $department->name }}"required>
    </div>
    <button type="submit" class="btn btn-primary">Zapisz</button>
</form>

{{-- Sekcja Pracowników --}}

<div>


    @if (count($department->workers) > 0)
    <h1 class="h3 mb-0 text-gray-800">Pracownicy działu</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Stanowisko</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $worker->name }}</td>
                        <td>{{ $worker->surname }}</td>
                        <td>{{ $worker->position }}</td>
                        <td><a href="{{ route('worker.edit', ['workerId' => $worker->id]) }}" class="btn btn-primary">Edytuj</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $workers->links() }}
    @else
        <h1 class="h3 mb-0 text-gray-800">Brak pracowników</h1>
    @endif
</div>

@endsection
