<details class="form-inline mb-2">
    <summary><b>Dodaj {{ $name }}</b></summary>
    <form method="POST" action="{{ $route }}">
        @csrf
        <input type="text" class="form-control" placeholder="Wpisz nazwę" name="name" id="newName" required>
        <button type="submit" class="btn btn-primary">Dodaj {{ $name }}</button>
    </form>
</details>
