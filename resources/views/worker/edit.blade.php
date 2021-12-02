@extends('layouts.layout')
@section('title')Edycja pracownika @endsection

@section('page-heading')Dodawanie pracownika @endsection

@section('content')


<form method="POST" action={{ route('worker.update')}}>
    @csrf
    <input type="hidden" name="id" value="{{ $worker->id }}">
    <div class='form-group'>
        <label for="name">Imię</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Podaj imię" value="{{ $worker->name }}" required>
    </div>
    <div class='form-group'>
        <label for="surname">Nazwisko</label>
        <input type="text" class="form-control" id="surname" name="surname" placeholder="Podaj nazwisko" value="{{ $worker->surname }}" required>
    </div>
    <div class='form-group'>
        <label for="name">Stanowisko</label>
        <input type="text" class="form-control" id="position" name="position" placeholder="Podaj stanowisko" value="{{ $worker->position }}" required>
    </div>

    <div class='form-group'>
        <label for="department">Wybierz dział</label>

        <select class="form-control" id='department_id' name='department_id'>
            <option value="{{ NULL }}"></option>
            @foreach ($departments as $department)
                @if ($department->id == $worker->department_id)
                    <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                @else
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class='form-group'>
        <label for="name">Numer telefonu</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Podaj numer telefonu" value="{{ $worker->phone }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Zapisz</button>
</form>


@endsection
