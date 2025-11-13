const urlParams = new URLSearchParams(window.location.search);
const dispositivoId = urlParams.get("dispositivo_id");

setTimeout(function () {
    window.location.href = `/?dispositivo_id=${dispositivoId}`;
}, 5000);