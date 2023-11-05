<?php
session_start();

if (isset($_SESSION['usuario'])) {
    include(__DIR__ . '/../configuracion/conexion.php');

    // Captura la hora de finalización de sesión
    $horaFinalizacionSesion = date('Y-m-d H:i:s');

    // Obtén el nombre de usuario de la sesión
    $username = $_SESSION['usuario'];

    // Actualiza la hora de finalización de sesión en la base de datos
    $query = "UPDATE usuarios SET hora_finalizacion_sesion = '$horaFinalizacionSesion' WHERE usuario = '$username'";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        // Cierra la sesión
        session_unset();
        session_destroy();

        // Redirige al usuario a la página de inicio de sesión
        header('Location: ../login.php');
    } else {
        echo "Error al actualizar la hora de finalización de sesión: " . mysqli_error($conexion);
    }
} else {
    // Si el usuario no está en sesión, redirige a la página de inicio de sesión
    header('Location: ../login.php');
}
?>


