@extends('layouts.layout')
@section('title', 'Lista kursów walut')

@section('header', 'Kursy walut')

@section('content')
@include('shared.messages')

<form method="GET">
        <input type="text" name="phrase" value="{{ old('phrase') }}" placeholder="Wpisz nazwę lub kod">
    <button type="submit" class="btn btn-success mb-2">Szukaj</button>
</form>

<form method="GET" action="{{ route('currency.downloadData') }}">
    <button type="submit" class="btn btn-primary">Pobierz dane</button>
</form>

@if ($allCurrency->isEmpty())
    <h2>Brak kursów walut</h2>
@else
    <table class="table table-striped table-hover center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Kod</th>
                <th>Kurs waluty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allCurrency as $currency)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $currency['name'] }}</td>
                    <td>{{ $currency['currency_code'] }}</td>
                    <td>{{ $currency['exchange_rate'] }}</td>
                </tr>
            @endforeach
        </tbody>
</table>

{{ $allCurrency->links() }}

@endif


@endsection
