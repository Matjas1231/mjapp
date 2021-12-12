@extends('layouts.layout')

@section('title') Lista pracowników @endsection

@section('page-heading') Lista pracowników @endsection


@section('content')


<form method="GET">
    <div class="form-inline">
        <div class="form-group mb-2">
            <label for="phrase">Wyszukaj: </label>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" id="filtername" name="filter" value="{{ $filter }}" placeholder="Imię lub nazwisko">
        </div>
        {{-- <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" id="filtername" name="filtersurname" value="{{ $filterSurname }}" placeholder="Nazwisko">
        </div> --}}
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" id="filterdeb" name="filterdeb" value="{{ $filterDeb }}"  placeholder="Dział">
        </div>
    </div>
    <button id="sss" type="submit" class="btn btn-primary">Szukaj</button>
</form>

<div>
    {{-- <input type="text" id="search" placeholder="Wyszukaj"> --}}

    <table class="table table-striped" id="datatable">
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
        <tbody id="tableSearch">
            @foreach ($workers as $worker)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $worker->id }}</td>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $worker->surname }}</td>
                    <td>
                        @if (!is_null($worker->department_id))
                            <a href="{{ route('department.edit', ['departmentId' => $worker->department_id]) }}">{{ $worker->department->name }}</a>
                        @else
                            {{ null }}
                        @endif
                    </td>
                    <td>{{ $worker->phone }}</td>
                    <td>
                        <a href="{{ route('worker.show', ['workerId' => $worker->id]) }}">Sczegóły</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{ $workers->links('pagination::bootstrap-4') }}</div>
</div>

@endsection

@section('script')

<script>

    // Wyszukiwanie po wszystkich kolumnach jQUery

    // var $rows = $('#tableSearch tr');
    // $('#search').keyup(function() {

    //     var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
    //         reg = RegExp(val, 'i'),
    //         text;

    //     $rows.show().filter(function() {
    //         text = $(this).text().replace(/\s+/g, ' ');
    //         return !reg.test(text);
    //     }).hide();
    // });

        // wyszukiwanie po jednej kolumnie
    // function myFunction() {
    //     var input = document.getElementById("myInput");
    // var filter = input.value.toUpperCase();
    // var table = document.getElementById("mytable");
    // var tr = table.getElementsByTagName("tr");
    // var tds = tr.getElementsByTagName('td');

    //     for (var i = 0; i < tr.length; i++) {
    //         var firstCol = tds[2].textContent.toUpperCase();
    //         var secondCol = tds[3].textContent.toUpperCase();
    //         if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
    //             tr[i].style.display = "";
    //         } else {
    //             tr[i].style.display = "none";
    //         }
    //     }
    // }

    // api datatable

    // $(document).ready(function() {
    //     $('#datatable').DataTable( {
    //     });
    // });

</script>


{{-- <script> // dobre

    let getUrl = window.location;
    let baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    let url = baseUrl + "/ajax-request-get";
    let filter = document.querySelector("#filterName");
    // let filterDep = document.querySelector("#filterDep");



    something();
    filter.addEventListener('keyup', something);
    // filterDep.addEventListener('keyup', something);

    function something()
    {
        xhttp = new XMLHttpRequest();
        // xhttp.open("GET", url +"?filter="+ filter.value + "&filterDep=" + filterDep.value, true);
        xhttp.open("GET", url +"?filter="+ filter.value, true);
        console.log(xhttp);
        xhttp.send();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const workers = JSON.parse(this.responseText);
                // console.log(workers);
                const workersValues = Object.values(workers)
                // console.log(workersValues);
                const workersArray = workersValues[0];
                // console.log(workersArray);

                output = '';
                workersValues.forEach(element => {
                    // console.log(element['name']);
                    output +=
                    "<tr>" +
                        // "<td>" + i + "</td>" +
                        "<td>" + element['id'] + "</td>" +
                        "<td>" + element['name'] + "</td>" +
                        "<td>" + element['surname'] +"</td>" +
                        "<td>" + element['position'] + "</td>" +
                        "<td>" +
                            (element['department_id'] ? "<a href={{ route('department.edit', ['departmentId' => ':departmentId']) }}".replace(':departmentId', element['department_id']) + '>' +
                            element['department']['name'] : '')+'</a>' +
                        "</td>" +
                        "<td>" + element['phone'] +"</td>" +
                        "<td>" +
                            "<a href={{ route('worker.show', ['workerId' => ':workerId']) }}> Szczegóły </a>".replace(':workerId', element['id']) +
                        "</td>" +
                    "</tr>";

                });
                document.querySelector("#ajax").innerHTML = output;
            }
        }
    }

</script> --}}

@endsection
