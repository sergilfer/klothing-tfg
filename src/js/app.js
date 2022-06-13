document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    //navegacionFija();
    eventListeners();
}

/*function navegacionFija() {
    const barra = document.querySelector('.header');
    const aparece = document.querySelector('.contenido-video');
    const body = document.querySelector('body');


    window.addEventListener('scroll', function () {
        if (aparece.getBoundingClientRect().bottom < 0) {
            barra.classList.add('fijo');
            body.classList.add('body-scroll');
        } else {
            barra.classList.remove('fijo');
            body.classList.remove('body-scroll');
        }
    });
}*/

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    const metodoContacto = document.querySelectorAll('input[name="contacto"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarContacto));
}

function mostrarContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono"  name="telefono" required>

            <label for="fecha">Fecha Llamada:</label>
            <input type="date" id="fecha"  name="fecha-llamada" required>

            <label for="hora">Hora Llamada:</label>
            <input type="time" id="hora" min="09:00" max="18:00"  name="hora-llamada" required>

        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">Email</label>
            <input type="email" placeholder="Tu Email" id="email" name="email" required>
        `;
    }
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}