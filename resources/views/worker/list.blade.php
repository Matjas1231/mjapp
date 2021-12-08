@extends('layouts.layout')

@section('title') Lista pracowników @endsection

@section('page-heading') Lista pracowników @endsection




@section('content')

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
        <tr>
            <td>LP</td>
            <td>Filtr</td>
            <td>

                {{-- <form> --}}
                    <input type="text" name="filterName" id="filterName" class="form-control">
                    {{-- <button type="button" name="filterName" id="filterName">Klik</button> --}}
                {{-- </form> --}}
                <p>Suggestions: <span id="txtHint"></span></p>
            </td>
            <td>Filtr</td>
            <td>Filtr</td>
            <td>Filtr</td>
            <td>Akcja</td>
        </tr>
        @foreach ($workers as $worker)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $worker->id }}</td>
                <td>{{ $worker->name }}</td>
                <td>{{ $worker->surname }}</td>
                <td>
                    @if (!is_null($worker->department_id))
                        {{ $worker->department->name }}
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



@endsection

@section('script')

<script>
    let test = document.querySelector("#filterName");
    if (test == null)
    {
        console.log = 'ssssssssss'
    } else {
        setTimeout(function() {
            test.addEventListener('keyup', something);
            function something()
            {
                console.log(test.value);
            }
        }, 3000);
    }
</script>

@endsection
