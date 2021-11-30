@extends('layouts.layout')

@section('title')Szczegóły pracownika @endsection

@section('page-heading') Szczegóły pracownika {{ $worker->name }} {{ $worker->surname }} @endsection

@section('content')

<div>
    <p>Imię: <b>{{ $worker->name }}</b></p>
    <p>Nazwisko: <b>{{ $worker->surname }}</b></p>
    <p>Stanowisko: <b>{{ $worker->position }}</b></p>
    <p>Dział: <b>{{ $worker->department->name }}</b></p>
    <p>Numer telefonu: <b>{{ $worker->phone }}</b></p>
</div>

<hr>

<div>
    <h1 class="h3 mb-0 text-gray-800">Komputery</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>1</th>
                <th>1</th>
                <th>1</th>
                <th>1</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>
</div>

<hr>

<div>
    <h1 class="h3 mb-0 text-gray-800">Peryferia</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>1</th>
                <th>1</th>
                <th>1</th>
                <th>1</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
