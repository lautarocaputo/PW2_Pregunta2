document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[type="radio"]');
    const enviarBtn = document.getElementById("enviarBtn");

    function updateButtonState() {
        const respuestaSeleccionada = [...radios].some(radio => radio.checked);
        enviarBtn.disabled = !respuestaSeleccionada;
        enviarBtn.style.backgroundColor = respuestaSeleccionada ? "" : "gray";
    }

    radios.forEach(function (radio) {
        radio.addEventListener("change", updateButtonState);
    });

    updateButtonState();
});

function iniciarTemporizador() {
    var temporizador = document.getElementById("temporizador");
    var tiempo = parseInt(temporizador.textContent);
    var intervalo = setInterval(function () {
        tiempo--;
        temporizador.textContent = tiempo;
        if (tiempo === 0) {
            clearInterval(intervalo);
            terminarPartida();
        }
    }, 1000);
}

function terminarPartida() {
    window.location.href = "/play/mostrarPuntuacion";
}