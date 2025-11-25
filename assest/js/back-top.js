document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('backToTop');

    // Mostrar u ocultar el botón al desplazarse
    window.onscroll = function() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            backToTopButton.style.display = 'block'; // Muestra el botón
        } else {
            backToTopButton.style.display = 'none'; // Oculta el botón
        }
    };

    // Función para volver arriba al hacer clic
    backToTopButton.onclick = function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Desplazamiento suave
        });
    };
});

