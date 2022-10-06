window.searchComputer = function searchComputer(path, routes) {
    const table = document.querySelector('#datatable-table');
    const paginateLinks = document.querySelector('#paginateLinks');
    const resultTablePlace = document.querySelector('#resultdatatable');
    const filters = document.querySelectorAll('.filter');
    const data = {
        'filterName': null,
        'filterComputerType': null,
        'filterBrand': null,
        'filterModel': null,
        'filterSerialNumber': null,
        'filterIpAddress': null,
        'filterMacAddress': null,
        'filterComputerName': null,
    }
    let timer;

    filters.forEach(filter => {
        filter.addEventListener('input', e => {
            clearTimeout(timer);

            timer = setTimeout(() => {
                if (filter.id === 'filtername') data.filterName = filter.value;
                if (filter.id === 'filtercomputertype') data.filterComputerType = filter.value;
                if (filter.id === 'filterbrand') data.filterBrand = filter.value;
                if (filter.id === 'filtermodel') data.filterModel = filter.value;
                if (filter.id === 'filterserialnumber') data.filterSerialNumber = filter.value;
                if (filter.id === 'filteripaddress') data.filterIpAddress = filter.value;
                if (filter.id === 'filtermacaddress') data.filterMacAddress = filter.value;
                if (filter.id === 'filtercomputername') data.filterComputerName = filter.value;

                if (data.filterName || data.filterComputerType || data.filterBrand || data.filterModel || data.filterSerialNumber || data.filterIpAddress || data.filterMacAddress || data.filterComputerName) {
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
                            let html = ''

                            data.forEach(el => {
                                html += `
                                <tr>
                                    <td>${el.id}</td>
                                    <td>${el.brand}</td>
                                    <td>${el.model}</td>
                                    <td>${el.computer_type.type}</td>
                                    <td>${el.ip_address}</td>
                                    <td>${el.mac_address}</td>
                                    <td>${el.computer_name}</td>
                                    <td>${el.serial_number}</td>
                                    <td><a href="${routes.worker.replace(':workerId', el.worker_id)}">${el.worker.name} ${el.worker.surname}</a></td>
                                    <td><a href="${routes.details.replace(':computerId', el.id)}">Szczegóły</a></td>
                                </tr>
                                `;
                            });

                            resultTable = `
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Marka</th>
                                        <th>Model</th>
                                        <th>Typ</th>
                                        <th>Adres IP</th>
                                        <th>Adres MAC</th>
                                        <th>Nazwa siec.</th>
                                        <th>Numer seryjny</th>
                                        <th>Pracownik</th>
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
