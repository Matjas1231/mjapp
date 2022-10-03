window.searchWorker = function searchWorker(path, csrfToken) {
    const table = document.querySelector('#datatable-table');
    const paginateLinks = document.querySelector('#paginateLinks');
    const resultTablePlace = document.querySelector('#resultdatatable');
    const filterForm = document.querySelector('#filterForm');

    filterForm.addEventListener('input', e => {
        setTimeout(() => {
            let filterName = document.querySelector('#filtername').value;
            let filterDep = document.querySelector('#filterdep').value;

            if (filterName || filterDep) {
                data = {
                    filterName: filterName,
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
                    paginateLinks.style.display = 'none';
                    let resultTable = '';

                    if (data.length > 0) {
                        html = '';
                        data.forEach(el => {
                            html += `
                            <tr>
                                <td>${el.id}</td>
                                <td>${el.name}</td>
                                <td>${el.surname}</td>
                                <td>${el.department ? el.department.name : ''}</td>
                                <td>${el.phone}</td>
                                <td><a href="workers/${el.id}/show">Szczegóły</a></td>
                            </tr>
                            `
                        });

                        resultTable = `
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imię</th>
                                    <th>Nazwisko</th>
                                    <th>Dział</th>
                                    <th>Telefon</th>
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
                paginateLinks.style.display = null;
            }
        }, 100);
    });
}
