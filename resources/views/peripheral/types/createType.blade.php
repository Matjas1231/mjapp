@extends('layouts.layout')

@section('title') Dodawanie typu komputera @endsection

@section('page-heading') Dodawanie typu komputera @endsection

@section('content')

<div>
    <form method="POST" action="{{ route('peripheral.type.store') }}">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" id="type" name="type" placeholder="Podaj nazwę" required>
        </div>
        <button type="submit" class="btn btn-primary">Zapisz</button>
    </form>
</div>

@endsection
