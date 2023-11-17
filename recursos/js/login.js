document.querySelector('form').addEventListener('submit', function(event) {
    var rol = document.getElementById('rol').value;
    var rolesValidos = ['administrador', 'cajero', 'mesero'];

    if (!rolesValidos.includes(rol)) {
        alert('Selecciona un rol válido.');
        event.preventDefault(); // Evita que el formulario se envíe si el rol no es válido.
    }
});

