window.Search = class Search
{
    constructor(path, routes) {
        this.path = path;
        this.routes = routes;
        this.table = document.querySelector('#datatable-table');
        this.paginateLinks = document.querySelector('#paginateLinks') ?? document.createElement('div', {'id': 'paginateLinks'});
        this.resultTablePlace = document.querySelector('#resultdatatable');
        this.filters = document.querySelectorAll('.filter');
        this.resultTable = '';

        this.data = this.generateEmptyDataObject();
        this.inputFieldsListener(this.data);
    }

    generateEmptyDataObject() {
        const emptyDataObject = {};

        this.filters.forEach(filter => {
            emptyDataObject[filter.id] = null;
        })

        return emptyDataObject;
    }

    inputFieldsListener(data) {
        this.filters.forEach(filter => {
            filter.addEventListener('input', e => {
                let timer;

                clearTimeout(timer);
                setTimeout(() => {
                    data[filter.id] = filter.value
                    if (data[filter.id]) {
                        this.sendData(data);
                    } else {
                        this.resultTablePlace.style.display = 'none';
                        this.table.style.display = null;
                        this.paginateLinks.style.display = null;
                    }
                }, 500);
            });
        });
    }

    sendData(data) {
        fetch(`${this.path}?${this.prepareDataToSend(data)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => {
            if (response.ok && response.status == 200) return response.json();
            else throw new Error(`Http error: ${response.status}`);
        })
        .then(jsonData => {
            this.generateTable(jsonData);
        })
        .catch(err => console.log(`Err: ${err}`));
    }

    generateTable(jsonData) {
        this.table.style.display = 'none';
        this.paginateLinks.style.display = 'none';
        this.resultTablePlace.style.display = null;

        if (jsonData.length > 0) {
            switch (location.pathname) {
                case '/workers':
                    this.resultTable = this.workerTable(jsonData);
                    break;
                case '/departments':
                    this.resultTable = this.deparmentTable(jsonData);
                    break;
                case '/softwares':
                    this.resultTable = this.softwareTable(jsonData);
                    break;
                case '/computers':
                    this.resultTable = this.computerTable(jsonData);
                    break;
            }
        } else {
            this.resultTable = `<center class="font-weight-bold mt-3">Brak wyników</center>`;
        }

        this.resultTablePlace.innerHTML = this.resultTable;
    }

    workerTable(jsonData) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.name}</td>
                <td>${el.surname}</td>
                <td>${el.department ? el.department.name : ''}</td>
                <td>${el.phone}</td>
                <td><a href="${this.routes.details.replace(':wokerId', el.id)}">Szczegóły</a></td>
            </tr>
            `
        });

        return `
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
    }

    deparmentTable(jsonData) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.name}</td>
                <td>
                <a href="${this.routes.edit.replace(':departmentId', el.id)}" class="btn btn-primary">Edytuj</a>
                <a href="${this.routes.delete.replace(':departmentId', el.id)}" class="btn btn-danger">Usuń</a>
                </td>
            </tr>
            `
        });

        return `
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
    }

    softwareTable(jsonData) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.producer}</td>
                <td>${el.name}</td>
                <td>${el.serial_number}</td>`;

                if (el.worker) {
                    html += `<td><a href="${this.routes.worker.replace(':workerId', el.worker_id)}">${el.worker.name} ${el.worker.surname}</a></td>`
                } else {
                    html += '<td>Brak pracownika</td>';
                }

                html += `<td>${el.expiry_date}</td>
                <td><a href="${this.routes.details.replace(':softwareId', el.id)}">Szczegóły</a></td>
            </tr>
            `;
        });

        return `
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
    }

    computerTable(jsonData) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.brand}</td>
                <td>${el.model}</td>
                <td>${el.computer_type.type}</td>
                <td>${el.ip_address}</td>
                <td>${el.mac_address}</td>
                <td>${el.computer_name}</td>
                <td>${el.serial_number}</td>`;

                if (el.worker) {
                    html += `<td><a href="${this.routes.worker.replace(':workerId', el.worker_id)}">${el.worker.name} ${el.worker.surname}</a></td>`
                } else {
                    html += '<td>Brak pracownika</td>';
                }

                `<td><a href="${this.routes.details.replace(':computerId', el.id)}">Szczegóły</a></td>
            </tr>
            `;
        });

        return `
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
    }


    prepareDataToSend(dataToCode) {
        const dataPart = [];
        for (let key in dataToCode)dataPart.push(encodeURIComponent(key) + "=" + encodeURIComponent(dataToCode[key]));

        return dataPart.join("&").replace(/%20/g, "+");
    }

}
