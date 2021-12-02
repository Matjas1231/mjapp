@extends('layouts.layout')
@section('title')Dodawanie pracownika @endsection

@section('page-heading')Dodawanie pracownika @endsection

@section('content')

<form method="POST" action="{{ route('worker.store')}}">
    @csrf
    <div class='form-group'>
        <label for="name">Imię</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Podaj imię" required>
    </div>
    <div class='form-group'>
        <label for="surname">Nazwisko</label>
        <input type="text" class="form-control" id="surname" name="surname" placeholder="Podaj nazwisko" required>
    </div>
    <div class='form-group'>
        <label for="name">Stanowisko</label>
        <input type="text" class="form-control" id="position" name="position" placeholder="Podaj stanowisko" required>
    </div>
    <div class='form-group'>
        <label for="department">Wybierz dział</label>
        <select class="form-control" id='department_id' name='department_id'>
            <option value="{{ NULL }}"></option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>
    <div class='form-group'>
        <label for="name">Numer telefonu</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Podaj numer telefonu" required>
    </div>
    <button type="submit" class="btn btn-primary">Dodaj</button>
</form>


@endsection
