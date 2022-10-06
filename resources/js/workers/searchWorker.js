window.searchWorker = function searchWorker(path) {
    const table = document.querySelector('#datatable-table');
    const paginateLinks = document.querySelector('#paginateLinks');
    const resultTablePlace = document.querySelector('#resultdatatable');
    const filters = document.querySelectorAll('.filter');
    const data = {
        'filterName': null,
        'filterDep': null
    }
    let timer;

    filters.forEach(filter => {
        filter.addEventListener('input', e => {
            clearTimeout(timer);

            timer = setTimeout(() => {
                if (filter.id == 'filtername') data.filterName = filter.value;
                if (filter.id == 'filterdep') data.filterDep = filter.value;

                if (data.filterDep || data.filterName) {
                    fetch(`${path}?${prepareDataToSend(data)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
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
            }, 500);
        });
    });
}
