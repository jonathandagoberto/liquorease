<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si se recibieron datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera y valida los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $rol = htmlspecialchars($_POST['rol']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    // Validación adicional si es necesario...

    // Utiliza Argon2 para hashear la contraseña
    $hashedPassword = password_hash($contrasena, PASSWORD_ARGON2I);

    // Prepara la consulta SQL con sentencia preparada
    $sql = "INSERT INTO `usuarios` (`nombre`, `direccion`, `telefono`, `email`, `rol`, `usuario`, `contrasena`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepara la sentencia
    $stmt = mysqli_prepare($conexion, $sql);

    // Vincula los parámetros
    mysqli_stmt_bind_param($stmt, "sssssss", $nombre, $direccion, $telefono, $email, $rol, $usuario, $hashedPassword);

    // Ejecuta la sentencia
    if (mysqli_stmt_execute($stmt)) {
        // Registro exitoso, redirige de nuevo a la página de registro de usuario
        header("Location: ../vistas/admin/registro.html");
        exit();
    } else {
        // Error en el registro
        echo "Error al registrar el usuario. Inténtalo de nuevo.";
    }

    // Cierra la conexión y la sentencia
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
