@extends('layouts.layout')
@section('title', 'Tłumacz deepl')
@section('page-heading', 'Tłumacz Deepl')

@section('content')
<div class="row">
    <textarea class="form-control" id="textareaToTranslate" maxlength="300"></textarea>
    <div>Liczba znaków: <span id="countLetters">0</span>/300</div>
</div>
<div class="row">
    <textarea readonly id="resultTranslation" class="form-control"></textarea>
</div>
<div>
    <input type="button" value="Tłumacz" id="translateButton" class="btn btn-sm btn-primary mt-3">
</div>
@endsection

@section('javascript')
<script>
    translateDeepl("{{ route('deepl.translation') }}", "{{ csrf_token() }}")
</script>
@endsection

