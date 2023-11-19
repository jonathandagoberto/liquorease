<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').addEventListener('submit', function(event) {
            var password = document.getElementById('txt_pass').value;

            if (password.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres.');
                event.preventDefault();
            } else {
                var btn = document.querySelector('button[type="submit"]');
                btn.style.backgroundColor = '#28a745'; // Cambia el color del botón a verde
                btn.style.borderColor = '#28a745';
                btn.style.color = 'white';
            }
        })
    });
</script>



