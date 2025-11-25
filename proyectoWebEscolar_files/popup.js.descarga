function showPopup(title, text) {
    document.getElementById('popupTitle').innerText = title;
    document.getElementById('popupText').innerText = text;
    document.getElementById('popup').style.display = 'block'; // Muestra el popup
}

document.getElementById('closePopup').onclick = function() {
    document.getElementById('popup').style.display = 'none'; // Oculta el popup
}

// Cierra el popup si se hace clic fuera del contenido
window.onclick = function(event) {
    if (event.target == document.getElementById('popup')) {
        document.getElementById('popup').style.display = 'none';
    }
}

