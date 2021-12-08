@extends('layouts.layout')

@section('title') Lista pracowników @endsection

@section('page-heading') Lista pracowników @endsection


@section('content')


<form method="GET" action="{{ route('worker.list') }}"class="form-inline">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj pracownika: </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" name="phrase" id="phrase"  class="form-control" value="{{ $phrase ?? '' }}" placeholder="Imię lub nazwisko">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Szukaj</button>
</form>

<div>
    <table class="table table-striped">
        <thead>
            <tr>
                    <th>Lp.</th>
                    <th>Id.</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Dział</th>
                    <th>Telefon</th>
                    <th>Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workers as $worker)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $worker->id }}</td>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $worker->surname }}</td>
                    <td>
                        @if (!is_null($worker->department_id))
                            <a href="{{ route('department.edit', ['departmentId' =>$worker->department_id]) }}">{{ $worker->department->name }}</a>
                        @else
                            {{ NULL }}
                        @endif
                    </td>
                    <td>{{ $worker->phone }}</td>
                    <td>
                        <a href="{{ route('worker.show', ['workerId' => $worker->id]) }}">Szczegóły</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection

@section('script')

<script>
    let url = new URL(window.location.href);
    let search_params = url.searchParams;
    let test = document.querySelector("#filterName");
    if (test == null)
    {
        console.log = 'ssssssssss'
    } else {

        test.addEventListener('keyup', something);
        function something()
        {
            console.log(test.value);
            search_params.set('filterName', test.value);
            url.search = search_params.toString();
            let new_url = url.toString();
            console.log(new_url);
                xhttp = new XMLHttpRequest();
                xhttp.open("GET", "{{  route('ajax') }}" + "?filter=" + test.value, true);
                xhttp.send();
        }
    }
</script>

@endsection
