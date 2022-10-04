window.searchDepartment = function searchDepartment(path, csrfToken, routes) {
    const table = document.querySelector('#datatable-table');
    const resultTablePlace = document.querySelector('#resultdatatable');
    const filter = document.querySelector('.filter');
    let timer;

    let data = {
        'filterDep': null
    }

    filter.addEventListener('input', e => {
        clearTimeout(timer);

        timer = setTimeout(() => {
            data.filterDep = filter.value;

            if (data.filterDep) {
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
                                <a href="${routes.edit.replace(':departmentId', el.id)}" class="btn btn-primary">Edytuj</a>
                                <a href="${routes.delete.replace(':departmentId', el.id)}" class="btn btn-danger">Usuń</a>
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
        }, 500);
    });
}
