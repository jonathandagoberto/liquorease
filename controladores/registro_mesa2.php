<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $numero_mesa = $_POST["numero_mesa"];
    $estado = $_POST["estado"];
    $descripcion = $_POST["descripcion"];
    $sede = $_POST["sede"]; // Asegúrate de que el nombre coincida con el formulario

    // Evita posibles ataques de inyección SQL utilizando sentencias preparadas
    $stmt = $conexion->prepare("INSERT INTO mesas (numero_mesa, estado, descripcion, sede_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $numero_mesa, $estado, $descripcion, $sede);

    if ($stmt->execute()) {
        // Registro exitoso, redirige de nuevo a la página de registro de mesas
        header("Location: ../vistas/admin/registromesa.html");
        exit();
    } else {
        // Error en el registro
        echo "Error al registrar la mesa. Inténtalo de nuevo.";
    }

    // Cierra la conexión a la base de datos
    $stmt->close();
    $conexion->close();
}
?>
