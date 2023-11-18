<?php
include('../../controladores/verificar_rol.php');
session_start();

if (!verificarRol('mesero')) {
    // El usuario no tiene permisos de mesero, redirige o muestra un mensaje de error
    header('Location: ../../pagina_de_error.php'); // Redirige a una página de error
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido, Mesero</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../recursos/css/style.css">
</head>
<body>
    <div class="container container-button"> 
        <a href="../../login.php" class="btn btn-danger btn-lg logout-button" id="salir-button">Salir</a>
    </div>

    <div class="container">
        <div class="main-title">Bienvenido, Mesero</div>
        <div class="admin-container"> <!-- Contenedor crema -->
            <div class="admin-buttons">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="pedido.html">
                            <button class="btn btn-primary btn-block">Tomar Pedido</button>
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button id="cancelarPedido" class="btn btn-primary btn-block">Cancelar Pedido</button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button id="confirmarPedido" class="btn btn-primary btn-block">Confirmar Pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
<!-- Agrega este script después de incluir las bibliotecas de jQuery y Bootstrap -->
<script>
    document.getElementById('cancelarPedido').addEventListener('click', CancelarPedido);
    document.getElementById('confirmarPedido').addEventListener('click', ConfirmarPedido);

    function CancelarPedido() {
        // Realiza una petición AJAX al servidor para cancelar el pedido
        $.ajax({
            url: '../../controladores/cancelar_pedido.php', // Ruta del controlador que maneja la cancelación
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Pedido cancelado exitosamente');
                    // Actualiza la interfaz o redirige según sea necesario
                } else {
                    alert('Error al cancelar el pedido');
                }
            },
            error: function() {
                alert('Error de conexión');
            }
        });
    }

    function ConfirmarPedido() {
        // Realiza una petición AJAX al servidor para confirmar el pedido
        $.ajax({
            url: '../../controladores/confirmar_pedido.php', // Ruta del controlador que maneja la confirmación
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Pedido confirmado exitosamente');
                    // Actualiza la interfaz o redirige según sea necesario
                } else {
                    alert('Error al confirmar el pedido');
                }
            },
            error: function() {
                alert('Error de conexión');
            }
        });
    }
</script>
</body>
</html>
