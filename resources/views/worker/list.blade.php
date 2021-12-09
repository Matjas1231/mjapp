@extends('layouts.layout')

@section('title') Lista pracowników @endsection

@section('page-heading') Lista pracowników @endsection


@section('content')


    <div class="form-inline">
    <div class="form-group mb-2">
        <label for="phrase">Wyszukaj pracownika: </label>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control" id="filterName" placeholder="Imię lub nazwisko">
        <input type="text" class="form-control" id="filterDep" placeholder="Dział">
    </div>
    </div>

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

@endsection

@section('script')

<script>

    let getUrl = window.location;
    let baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    let url = baseUrl + "/ajax-request-get";
    let filter = document.querySelector("#filterName");
    let filterDep = document.querySelector("#filterDep");
    // let alldata = 'true';

    xhttp = new XMLHttpRequest();

    something()
    filter.addEventListener('keyup', something);
    filterDep.addEventListener('keyup', something);

    function something()
    {
        xhttp.open("GET", url +"?filter="+ filter.value + "&filterDep=" + filterDep.value, true);
        console.log(xhttp);
        xhttp.send();
    }

    xhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
                const xhttp = new XMLHttpRequest();
                const workers = JSON.parse(this.responseText);
                let workerArray = Object.values(workers);
                let output = '';
                let i = 1;
                console.log(workerArray);
                workerArray[0].forEach(element => {
                    output +=
                    "<tr>" +
                        "<td>" + i + "</td>" +
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
                    i++;
                });
                console.log(output);

                document.querySelector("#ajax").innerHTML = output;
            }
        }

</script>

@endsection
