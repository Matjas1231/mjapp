import { Tables } from "./tables/Tables";

window.Search = class Search
{
    constructor(path, routes) {
        this.resultTable = '';
        this.typingTimer;

        this.path = path;
        this.routes = routes;
        this.table = document.querySelector('#datatable-rows');
        this.paginateLinks = document.querySelector('#paginateLinks') ?? document.createElement('div', {'id': 'paginateLinks'});
        this.resultTablePlace = document.querySelector('#resultdatatable');
        this.filters = document.querySelectorAll('.filter');
        this.withoutWorker = document.querySelector('#filterWithoutWorker') ?? null;

        this.data = this.generateEmptyDataObject();
        this.inputFieldsListener(this.data);
        this.clearTimer();

        if (this.withoutWorker) this.checkboxListener();
    }

    generateEmptyDataObject() {
        const emptyDataObject = {};
        this.filters.forEach(filter => emptyDataObject[filter.id] = null);
        return emptyDataObject;
    }

    inputFieldsListener(data) {
        this.filters.forEach(filter => {
            filter.addEventListener('keyup', e => {
                clearTimeout(this.typingTimer);

                this.typingTimer = setTimeout(() => {

                    let send = false;
                    data[filter.id] = filter.value === '' ? null : filter.value;

                    for (const [k, v] of Object.entries(data)) if (v) send = true;

                    if (send) this.sendData(data);
                    else this.showtable();
                }, 100);

            });
        });
    }

    async sendData(data) {
        return await fetch(`${this.path}?${this.prepareDataToSend(data)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => {
            if (response.ok && response.status == 200) {
                return response.json();
            }
            else throw new Error(`Http error: ${response.status}`);
        })
        .then(jsonData => {
            if (jsonData['message'] === 'empty') {
                this.noResultTable();
                return;
            }

            this.generateTable(jsonData);
        })
        .catch(err => console.log(`Err: ${err}`));
    }

    generateTable(jsonData) {
        this.hideTable();

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
            case '/peripherals/types':
                this.resultTable = Tables.simpleTable(jsonData, this.routes, 'peripheralType');
                break;
        }

        this.resultTablePlace.innerHTML = this.resultTable;
    }

    noResultTable() {
        this.hideTable();
        let res = document.querySelector('#resultTableRow') ?? null;

        if (!res) {
            this.resultTablePlace.innerHTML = `<tr class="font-weight-bold mt-3" id="resultTableRow"><td colspan="100%"><center>Brak wyników</center></td></tr>`;
        }

    }

    checkboxListener() {
        let data = { filterWithoutWorker: false };
        this.withoutWorker.addEventListener('click', e => {
            data = { filterWithoutWorker: this.withoutWorker.checked }

            if (this.withoutWorker.checked) {
                this.sendData(data);
            } else {
                this.hideTable();
                this.showtable();
            }
        });
    }

    hideTable() {
        this.table.style.display = 'none';
        this.paginateLinks.style.display = 'none';
        this.resultTablePlace.style.display = null;
    }

    showtable() {
        this.table.style.display = null;
        this.paginateLinks.style.display = null;
        this.resultTablePlace.style.display = 'none';
        this.resultTablePlace.innerHTML = '';
    }

    prepareDataToSend(dataToCode) {
        const dataPart = [];
        for (let key in dataToCode)dataPart.push(encodeURIComponent(key) + "=" + encodeURIComponent(dataToCode[key]));

        return dataPart.join("&").replace(/%20/g, "+");
    }

    clearTimer() {
        this.filters.forEach(filter => {
            filter.addEventListener('keydown', () => {
                clearTimeout(this.typingTimer);
            })
        })
    }
}
