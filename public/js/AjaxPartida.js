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

    var tiempoRestante = parseInt(localStorage.getItem("tiempoRestante")) || 10;

    enviarTiempoRestanteAlServidor(tiempoRestante);
});

function iniciarTemporizador() {
    var temporizador = document.getElementById("temporizador");
    var tiempo = parseInt(localStorage.getItem("tiempoRestante")) || 10;

    temporizador.textContent = tiempo;

    var intervalo = setInterval(function () {
        tiempo--;

        localStorage.setItem("tiempoRestante", tiempo);

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

function enviarTiempoRestanteAlServidor(tiempoRestante) {
    fetch("/play/setTiempoRestante", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ tiempoRestante: tiempoRestante }),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al actualizar el tiempo restante');
            }
            return response.json();
        })
        .then(data => {
            // Manejar la respuesta si es necesario
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error.message);
        });
}