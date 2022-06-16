@extends('layouts.layout')
@section('title', 'Dodawanie nowego działu')

@section('page-heading')Dodawanie nowego działu @endsection

@section('content')

<form method="POST" action="{{ route('department.store')}}">
    @csrf
    <div class='form-group'>
        <label for="name">Nazwa działu</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Podaj nazwę działu" required>
    </div>
    <button type="submit" class="btn btn-primary">Dodaj</button>
</form>


@endsection
