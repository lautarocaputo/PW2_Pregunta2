function iniciarTemporizador() {
    var temporizador = document.getElementById("temporizador");
    var tiempo = parseInt(localStorage.getItem("tiempo")) || 10;

    temporizador.textContent = tiempo;

    var intervalo = setInterval(function () {
        tiempo--;
        localStorage.setItem("tiempo", tiempo);
        temporizador.textContent = tiempo;

        if (tiempo === 0) {
            clearInterval(intervalo);
            document.getElementById("formularioPlay").submit();
        }
    }, 1000);
}

document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById('formularioPlay');

    form.addEventListener('submit', function(e) {
    
        if (form.classList.contains('submitted')) {
            e.preventDefault();
            return;
        }

        form.classList.add('submitted');

        localStorage.setItem("tiempo", 10);
    });
});