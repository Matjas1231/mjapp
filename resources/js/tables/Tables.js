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

        return html;
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

        return html;
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

        return html;
    }

    static simpleTable(jsonData, routes, type) {
        let html = '';

        jsonData.forEach(el => {
            html += `
            <tr>
                <td>${el.id}</td>
                <td>${el.name}</td>
                <td>`;

                switch (type) {
                    case 'department':
                        html +=`<a href="${routes.edit.replace(':departmentId', el.id)}" class="btn btn-primary">Edytuj</a>
                        <a href="${routes.delete.replace(':departmentId', el.id)}" class="btn btn-danger">Usuń</a>`;
                        break;
                    case 'computerType':
                        html +=`<a href="${routes.edit.replace(':computerTypeId', el.id)}" class="btn btn-primary">Edytuj</a>
                        <a href="${routes.delete.replace(':computerTypeId', el.id)}" class="btn btn-danger">Usuń</a>`;
                        break;
                    case 'peripheralType':
                        html +=`<a href="${routes.edit.replace(':peripheralTypeId', el.id)}" class="btn btn-primary">Edytuj</a>
                        <a href="${routes.delete.replace(':peripheralTypeId', el.id)}" class="btn btn-danger">Usuń</a>`;
                        break;
                }

            html += `</td>
            </tr>
            `;
        });

        return html;
    }
}
