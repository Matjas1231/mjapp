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
    <tbody class="ajax">
        @foreach ($workers as $worker)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $worker->id }}</td>
            <td>{{ $worker->name }}</td>
            <td>{{ $worker->surname }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
