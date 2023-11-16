<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion) {
    // Consulta para obtener la lista de usuarios
    $sql = "SELECT id, nombre, direccion, telefono, email, rol, usuario FROM usuarios";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["direccion"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["rol"] . "</td>";
            echo "<td>" . $row["usuario"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No se encontraron usuarios.</td></tr>";
    }
} else {
    echo "Error en la conexión a la base de datos.";
}

// Verifica si se recibieron datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera y valida los datos del formulario
    $idUsuario = htmlspecialchars($_POST['idUsuario']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $rol = htmlspecialchars($_POST['rol']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    // Validación adicional si es necesario...

    // Utiliza Argon2 para hashear la nueva contraseña, si se proporcionó
    $hashedPassword = ($contrasena !== '') ? password_hash($contrasena, PASSWORD_ARGON2I) : null;

    // Realiza la actualización directa sin sentencia preparada
    $sql = "UPDATE `usuarios` SET 
            `nombre` = '$nombre', 
            `direccion` = '$direccion', 
            `telefono` = '$telefono', 
            `email` = '$email', 
            `rol` = '$rol', 
            `usuario` = '$usuario', 
            `contrasena` = '$hashedPassword'
            WHERE `id` = '$idUsuario'";

    // Ejecuta la consulta
    if (mysqli_query($conexion, $sql)) {
        // Actualización exitosa, redirige a la página de inicio o a donde sea necesario
        header("Location: ../vistas/admin/actualizar_usuario.html");
        exit();
    } else {
        // Error en la actualización
        echo "Error al actualizar el usuario. Inténtalo de nuevo.";
    }

    // Cierra la conexión
    mysqli_close($conexion);
}
?>
