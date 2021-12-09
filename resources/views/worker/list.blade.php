@extends('layouts.layout')

@section('title') Lista pracowników @endsection

@section('page-heading') Lista pracowników @endsection


@section('content')


<form method="GET" action="{{ route('worker.list') }}"class="form-inline">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj pracownika: </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" name="phraseName" id="phraseName"  class="form-control" value="{{ $phraseName }}" placeholder="Imię lub nazwisko">
        {{-- <input type="text" name="phraseDep" id="phraseDep"  class="form-control" value="{{ $phraseDep }}" placeholder="Dział"> --}}
    </div>
    <button type="submit" class="btn btn-primary mb-2">Szukaj</button>
</form>
    <input type="text" class="form-control" id="filterName">
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
        <tbody id="ajax">

        </tbody>
    </table>
</div>


{{-- <tbody>
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
</tbody> --}}

@endsection

@section('script')

<script>

    let getUrl = window.location;
    let baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    let url = baseUrl + "/ajax-request-get";
    let filter = document.querySelector("#filterName");
    if (filter == null)
    {
        console.log = 'ssssssssss'
    } else {
        xhttp = new XMLHttpRequest();

        filter.addEventListener('click', something);
        function something()
        {
            // console.log(filter.value);
                xhttp.open("GET", url +"?filter="+ filter.value, true);
                xhttp.send();
        }


    }
    xhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
                const xhttp = new XMLHttpRequest();
                const all_items = JSON.parse(this.responseText);
                // console.log(all_items);
                output = '';
                // console.log(all_items[0]);
                // console.log(Object.values(all_items));
                // for (const item of Object.values(all_items)) {
                //     console.log(item);
                //     }
                for (const v in Object.values(all_items)) {
                    console.log(all_items[v]);
                    output +=
                    "<tr><td>" +
                    all_items['id'] +
                    "</td>" + "<td>" +
                    all_items['name'] +
                    "</td>" + "<td>" +
                    all_items['surname'] +
                    "</td>" + "<td>" +
                    all_items['position'] +
                    "</td>" + "<td>" +
                    all_items['department_id'] +
                    "</td>" + "<td>" +
                    all_items['phone'] +
                    "</td></tr>";
                }
                // }
                // all_items.forEach(e => {
                //     console.log(all_items[e]);
                //     "<tr><td>" +
                //     all_items[e]['id'] +
                //     "</td>" + "<td>" +
                //     all_items[e]['name'] +
                //     "</td>" + "<td>" +
                //     all_items[e]['surname'] +
                //     "</td>" + "<td>" +
                //     all_items[e]['position'] +
                //     "</td>" + "<td>" +
                //     all_items[e]['department_id'] +
                //     "</td>" + "<td>" +
                //     all_items[e]['phone'] +
                //     "</td></tr>";
                // });


                    return output;
            }
            document.querySelector("#ajax").appendText(output);

        }
</script>

@endsection
