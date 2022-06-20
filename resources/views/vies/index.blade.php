@extends('layouts.layout')

@section('title', 'VIES')

@section('page-heading', 'VIES')

@section('content')

@include('shared.messages')

<form method="GET" class="form-inline">
    <div class="form-row">
        <div class="col">
            <input type="text" name="country_code" placeholder="Kod kraju" class="form-control" required>
        </div>
        <div class="col">
            <input type="text" name="nip" placeholder="NIP" class="form-control" required>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Wyślij</button>
        </div>
    </div>
</form>

@if (!empty($companyData) && $companyData)
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th> NIP </th>
                    <th> Kod kraju </th>
                    <th> Czy prawidłowy </th>
                    <th> Nazwa firmy </th>
                    <th> Adres firmy </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $companyData['nip'] }} </td>
                    <td> {{ $companyData['countryCode'] }} </td>
                    <td> {{ $companyData['valid'] }} </td>
                    <td> {{ $companyData['companyName'] }} </td>
                    <td> {{ $companyData['companyAddress'] }} </td>
                </tr>
            </tbody>
        </table>

    </div>
@endif

@endsection
