window.searchSoftware = function searchSoftware(path, routes) {
    const table = document.querySelector('#datatable-table');
    const paginateLinks = document.querySelector('#paginateLinks');
    const resultTablePlace = document.querySelector('#resultdatatable');
    const filters = document.querySelectorAll('.filter');
    const data = {
        'filterName': null,
        'filterProd': null,
        'filterNa': null,
        'filterSn': null,
    }
    let timer;

    filters.forEach(filter => {
        filter.addEventListener('input', e => {
            clearTimeout(timer);

            setTimeout(() => {
                if (filter.id === 'filtername') data.filterName = filter.value;
                if (filter.id === 'filterprod') data.filterProd = filter.value;
                if (filter.id === 'filterna') data.filterNa = filter.value;
                if (filter.id === 'filtersn') data.filterSn = filter.value;

                if (data.filterName || data.filterProd || data.filterNa || data.filterSn) {
                    fetch(`${path}?${prepareDataToSend(data)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/x-www-form-urlencoded',
                        }
                    })
                    .then(response => {
                        if (response.ok && response.status == 200) return response.json();
                        else throw new Error(`Http error: ${response.status}`);
                    })
                    .then(data => {
                        table.style.display = 'none';
                        paginateLinks.style.display = 'none';
                        resultTablePlace.style.display = null;
                        let resultTable = '';

                        if (data.length > 0) {
                            let html = '';

                            data.forEach(el => {
                                html += `
                                <tr>
                                    <td>${el.id}</td>
                                    <td>${el.producer}</td>
                                    <td>${el.name}</td>
                                    <td>${el.serial_number}</td>
                                    <td><a href="${routes.worker.replace(':workerId', el.worker_id)}">${el.worker.name} ${el.worker.surname}</a></td>
                                    <td>${el.expiry_date}</td>
                                    <td><a href="${routes.details.replace(':softwareId', el.id)}">Szczegóły</a></td>
                                </tr>
                                `;
                            });

                            resultTable = `
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Producent</th>
                                        <th>Nazwa</th>
                                        <th>Numer seryjny</th>
                                        <th>Pracownik</th>
                                        <th>Data ważności</th>
                                        <th>Akcja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${html}
                                </tbody>
                            </table>
                            `;
                        }  else {
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
