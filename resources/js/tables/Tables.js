export class Tables
{
    static workerTable(jsonData, routes) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.name}</td>
                <td>${el.surname}</td>
                <td>${el.department ? el.department.name : ''}</td>
                <td>${el.phone}</td>
                <td><a href="${routes.details.replace(':wokerId', el.id)}">Szczegóły</a></td>
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

    static softwareTable(jsonData, routes) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.producer}</td>
                <td>${el.name}</td>
                <td>${el.serial_number}</td>`;

                if (el.worker) {
                    html += `<td><a href="${routes.worker.replace(':workerId', el.worker_id)}">${el.worker.name} ${el.worker.surname}</a></td>`
                } else {
                    html += '<td>Brak pracownika</td>';
                }

                html += `<td>${el.expiry_date}</td>
                <td><a href="${routes.details.replace(':softwareId', el.id)}">Szczegóły</a></td>
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

    static peripheralAndComputerTable(jsonData, routes, type) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.brand}</td>
                <td>${el.model}</td>`;

                if (type === 'peripheral' || type === 'computer') {
                    if (el.peripheral_type) {
                        html += `<td> <a href="${routes.type.replace(':peripheralTypeId', el.peripheral_type.id)}">${el.peripheral_type.type}</a></td>`;
                    }

                    if (el.computer_type) {
                        html += `<td> <a href="${routes.type.replace(':computerTypeId', el.computer_type.id)}">${el.computer_type.type}</a></td>`;
                    }
                } else {
                    html += `<td>Nieprzypisany typ</td>`;
                }

                html += `
                <td>${el.ip_address}</td>
                <td>${el.mac_address}</td>
                <td>${el.network_name}</td>
                <td>${el.serial_number}</td>
                `;

                if (el.worker) {
                    html += `<td><a href="${routes.worker.replace(':workerId', el.worker_id)}">${el.worker.name} ${el.worker.surname}</a></td>`;
                } else {
                    html += '<td>Brak pracownika</td>';
                }

                switch (type) {
                    case 'peripheral':
                        html += `<td><a href="${routes.details.replace(':peripheralId', el.id)}">Szczegóły</a></td>`;
                        break;
                    case 'computer':
                        html += `<td><a href="${routes.details.replace(':computerId', el.id)}">Szczegóły</a></td>`;
                        break;
                }

            html += `</tr>`;
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

    static simpleTable(jsonData, routes, type) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.name}</td>
                <td>`;

                if (type === 'department') {
                    html +=`<a href="${routes.edit.replace(':departmentId', el.id)}" class="btn btn-primary">Edytuj</a>
                    <a href="${routes.delete.replace(':departmentId', el.id)}" class="btn btn-danger">Usuń</a>`;
                }

                if (type === 'computerType') {
                    html +=`<a href="${routes.edit.replace(':computerTypeId', el.id)}" class="btn btn-primary">Edytuj</a>
                    <a href="${routes.delete.replace(':computerTypeId', el.id)}" class="btn btn-danger">Usuń</a>`;
                }

            html += `</td>
            </tr>
            `;
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
}
