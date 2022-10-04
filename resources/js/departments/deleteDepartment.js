window.deleteDepartment = function deleteDepartment(path) {
    const deleteButtons = document.querySelectorAll('.deleteButton');

    deleteButtons.forEach(deleteButton => {
        deleteButton.addEventListener('click', e => {
            const departmentName = deleteButton.parentElement.previousElementSibling.innerText;
            confirm(`Usunąć dział o nazwie "${departmentName}"?`);

            const tableRow = deleteButton.parentElement.parentElement;
            const departmentId = deleteButton.dataset.id;

            deleteButton.disabled = true;

            fetch(path.replace(':departmentId', departmentId))
            .then(response => {
                if (response.ok && response.status === 200) {
                    tableRow.remove();
                } else {
                    throw new Error(`Http error: ${response.status}`);
                }
            })
            .catch(err => console.log(`Err: ${err}`));
        });
    });
}
