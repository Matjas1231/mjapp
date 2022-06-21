@extends('layouts.layout')

@section('title', 'VIES')

@section('page-heading', 'VIES')

@section('content')

@include('shared.messages')

<form method="GET" class="form-inline">
    <div class="form-row">
        <div class="col">
            <select class="form-control" id="" name="country_code">
                <option value=""> -- </option>
                <option value="AT">	AT-Austria </option>
                <option value="BE">	BE-Belgia </option>
                <option value="BG">	BG-Bułgaria </option>
                <option value="CY">	CY-Cypr </option>
                <option value="CZ">	CZ-Czechy </option>
                <option value="DE">	DE–Niemcy </option>
                <option value="DK">	DK-Dania </option>
                <option value="EE">	EE-Estonia </option>
                <option value="EL">	EL-Grecja </option>
                <option value="ES">	ES-Hiszpania </option>
                <option value="FI">	FI-Finlandia </option>
                <option value="FR">	FR-Francja </option>
                <option value="HR">	HR-Chorwacja </option>
                <option value="HU">	HU-Węgry </option>
                <option value="IE">	IE-Irlandia </option>
                <option value="IT">	IT-Włochy </option>
                <option value="LT">	LT-Litwa </option>
                <option value="LU">	LU-Luksemburg </option>
                <option value="LV">	LV-Łotwa </option>
                <option value="MT">	MT-Malta </option>
                <option value="NL">	NL-Holandia </option>
                <option value="PL">	PL-Polska </option>
                <option value="PT">	PT-Portugalia </option>
                <option value="RO">	RO-Rumunia </option>
                <option value="SE">	SE-Szwecja </option>
                <option value="SI">	SI-Słowenia </option>
                <option value="SK">	SK-Słowacja </option>
                <option value="XI">	XI-Irlandii Północnej </option>
            </select>
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
