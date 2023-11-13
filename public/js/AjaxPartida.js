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

    var tiempoRestante = json_encode(tiempoRestante);

    var temporizador = document.getElementById("temporizador");
    temporizador.textContent = tiempoRestante;

    var intervalo = setInterval(function () {
        tiempoRestante--;

        if (tiempoRestante < 0) {
            tiempoRestante = 0;
        }

        temporizador.textContent = tiempoRestante;

        if (tiempoRestante === 0) {
            clearInterval(intervalo);
        }
    }, 1000);
});
