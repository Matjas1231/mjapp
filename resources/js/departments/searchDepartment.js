window.searchDepartment = function searchDepartment(path, csrfToken) {
    const table = document.querySelector('#datatable-table');
    const resultTablePlace = document.querySelector('#resultdatatable');
    const filterForm = document.querySelector('#filterForm');

    filterForm.addEventListener('input', e => {
        setTimeout(() => {
            let filterDep = document.querySelector('#filterdep').value;

            if (filterDep) {
                data = {
                    filterDep: filterDep
                };

                fetch(path, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (response.ok && response.status == 200) return response.json();
                    else throw new Error(`Http error: ${response.status}`);
                })
                .then(data => {
                    table.style.display = 'none';
                    resultTablePlace.style.display = null;
                    let resultTable = '';

                    if (data.length > 0) {
                        html = '';
                        data.forEach(el => {
                            html += `
                            <tr>
                                <td>${el.id}</td>
                                <td>${el.name}</td>
                                <td>
                                    <a href="departments/${el.id}/edit" class="btn btn-primary">Edytuj</a>
                                    <a href="departments/${el.id}/delete" class="btn btn-danger">Usuń</a>
                                </td>
                            </tr>
                            `
                        });

                        resultTable = `
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nazwa</th>
                                    <th>Akcja</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${html}
                            </tbody>
                        </table>
                        `;

                    } else {
                        resultTable = `<center class="font-weight-bold mt-3">Brak wyników</center>`;
                    }

                    resultTablePlace.innerHTML = resultTable;
                })
                .catch(err => console.log(`Err: ${err}`));
            } else {
                resultTablePlace.style.display = 'none';
                table.style.display = null;
            }
        }, 100)
    });
}
