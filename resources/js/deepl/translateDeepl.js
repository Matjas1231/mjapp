window.translateDeepl = function translateDeepl(pathToTranslation, csrfToken) {
    let textareaToTranslation = document.querySelector('#textareaToTranslate');
    let countletters = document.querySelector('#countLetters');
    let resultTranslation = document.querySelector('#resultTranslation');
    let translateButton = document.querySelector('#translateButton');

    countletters.innerHTML = textareaToTranslation.value.length;

    textareaToTranslation.addEventListener('input', () => {
        countletters.innerHTML = textareaToTranslation.value.length;
    });

    translateButton.addEventListener('click', () => {
        translateButton.disabled = true;
        data = {
            'dataToTranslation': textareaToTranslation.value
        }

        // AJAX z użyciem `fetch`
        fetch(pathToTranslation, {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (response.ok) return response.json();
            else throw new Error(`Http error: ${response.status}`);
        })
        .then(response => {
            resultTranslation.value  = response.translatedText;
            translateButton.disabled = false;
        })
        .catch(error => console.log("Błąd: ", error));
    });
}
