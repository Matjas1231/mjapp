window.prepareDataToSend = function prepareDataToSend(dataToCode) {
    const dataPart = [];
    for (let key in dataToCode)dataPart.push(encodeURIComponent(key) + "=" + encodeURIComponent(dataToCode[key]));

    return dataPart.join("&").replace(/%20/g, "+");
}
