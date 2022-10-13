import { Tables } from "./tables/Tables";

window.Search = class Search
{
    constructor(path, routes) {
        this.path = path;
        this.routes = routes;
        this.table = document.querySelector('#datatable-rows');
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
                    let send = false;
                    data[filter.id] = filter.value

                    for (const [k, v] of Object.entries(data)) if (v) send = true;

                    if (send) {
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
        fetch(`${this.path}?${this.#prepareDataToSend(data)}`, {
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
                    this.resultTable = Tables.workerTable(jsonData, this.routes);
                    break;
                case '/departments':
                    this.resultTable = Tables.simpleTable(jsonData, this.routes, 'department');
                    break;
                case '/softwares':
                    this.resultTable = Tables.softwareTable(jsonData, this.routes);
                    break;
                case '/computers':
                    this.resultTable = Tables.peripheralAndComputerTable(jsonData, this.routes, 'computer');
                    break;
                case '/computers/types':
                    this.resultTable = Tables.simpleTable(jsonData, this.routes, 'computerType');
                    break;
                case '/peripherals':
                    this.resultTable = Tables.peripheralAndComputerTable(jsonData, this.routes, 'peripheral');
                    break;
            }
        } else {
            this.resultTable = `<tr class="font-weight-bold mt-3"><td colspan="100%"><center>Brak wyników</center></td></tr>`;
        }

        this.resultTablePlace.innerHTML = this.resultTable;
    }

    #prepareDataToSend(dataToCode) {
        const dataPart = [];
        for (let key in dataToCode)dataPart.push(encodeURIComponent(key) + "=" + encodeURIComponent(dataToCode[key]));

        return dataPart.join("&").replace(/%20/g, "+");
    }
}
