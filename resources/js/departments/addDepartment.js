window.addDepartment = function addDepartment(path, csrfToken, routes) {
    const addButton = document.querySelector('#addButton');
    const departmentTableBody = document.querySelector('#departmentTableBody');
    const saveDepartmentDiv = document.querySelector('#saveDepartmentDiv');

    addButton.addEventListener('click', e => {
        const data = {
            name: null
        }

        addButton.hidden = true;
        saveDepartmentDiv.hidden = '';
        saveDepartmentDiv.innerHTML = `
        <div class="form-inline mb-2" id="saveDiv">
            <div class="form-group mr-1">
                <input type="text" class="form-control" placeholder="Wpisz nazwę działu" id="newDepartmentName" required>
            </div>
        </div>

        <div id="errorDiv" style="color:red" class="mb-1" hidden>
            Proszę wpisać nazwę działu
        </div>

        <div class="mb-2">
            <button id="saveButton" class="btn btn-sm btn-primary">Zapisz</button>
            <button id="cancelButton" class="btn btn-sm btn-danger">Anuluj</button>
        </div>
        `;

        const cancelButton = document.querySelector('#cancelButton');
        const saveButton = document.querySelector('#saveButton');
        const saveDiv = document.querySelector('#saveDiv');

        cancelButton.addEventListener('click', e => {
            saveDiv.remove();
            saveDepartmentDiv.hidden = true;
            addButton.hidden = '';
        });

        saveButton.addEventListener('click', e => {
            const newDeparmentName = document.querySelector('#newDepartmentName');

            if (!newDeparmentName.value) {
                const errorDiv = document.querySelector('#errorDiv');
                errorDiv.hidden = '';
                newDeparmentName.style.borderColor = 'red';
                return false;
            }

            saveButton.disabled = true;

            data.name = newDeparmentName.value;

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
                if (response.ok && response.status === 200) return response.json();
                else throw new Error(`Http error: ${response.status}`);
            })
            .then(id => {
                saveDiv.remove();
                saveDepartmentDiv.hidden = true;

                showAnimate() // Animacja pokazania informacji o dodaniu działu

                departmentTableBody.innerHTML += `
                <tr>
                    <td>${id}</td>
                    <td>${newDeparmentName.value}</td>
                    <td>
                        <a href="${routes.edit.replace(':departmentId', id)}" class="btn btn-primary">Edytuj</a>
                        <a class="btn btn-danger deleteButton" data-id=${id}>Usuń</a>
                    </td>
                </tr>
                `;
            })
            .catch((err => console.log(`Err: ${err}`)));
        });
    });
}

function showAnimate() {
    const hiddenSuccessDiv = document.querySelector('#hiddenDiv');
    hiddenSuccessDiv.hidden = '';

    if (hiddenSuccessDiv.classList.contains('hide-out')) {
        hiddenSuccessDiv.classList.remove('hide-out');
    }

    hiddenSuccessDiv.classList.add('show-message', 'py-2', 'px-2', 'mb-2');
    hiddenSuccessDiv.classList.remove('hide-in');

    setTimeout(() => {
        saveButton.disabled = false;
        hiddenSuccessDiv.classList.add('hide-out');
        hiddenSuccessDiv.classList.remove('show-message');

        setTimeout(() => {
            hiddenSuccessDiv.hidden = true;
            hiddenSuccessDiv.classList.remove('py-2', 'px-2', 'mb-2');
            addButton.hidden = '';// Przycisk do dodawania
        }, 250);
    }, 1500);
}
