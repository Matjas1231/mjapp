@extends('layouts.layout')
@section('title', 'Dodawnie nowego typu komputera')

@section('page-heading') Dodawanie nowego typu komputera @endsection



@section('content')


<form method="POST" action="{{ route('computer.type.store') }}">
    @csrf
    <div class='form-group'>
        <label for="name">Nazwa typu</label>
        <input type="text" class="form-control" id="type" name="type" placeholder="Podaj nazwę typu" required>
    </div>
    <button type="submit" class="btn btn-primary">Zapisz</button>
</form>


@endsection
