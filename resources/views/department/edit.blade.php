@extends('layouts.layout')
@section('title')Edycja działu @endsection

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


@endsection
