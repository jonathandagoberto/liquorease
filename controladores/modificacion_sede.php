<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sede_id = $_POST['sede_id'];
    $nuevo_nombre = $_POST['nuevo_nombre'];

    // Actualiza el nombre de la sede
    $sql = "UPDATE sedes SET nombre = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nuevo_nombre, $sede_id);

    if ($stmt->execute()) {
        echo "El nombre de la sede se ha modificado correctamente.";
    } else {
        echo "Error al modificar el nombre de la sede: " . $stmt->error;
    }

    // Cierra la conexión
    $stmt->close();
    $conexion->close();

    // Redirige a la página después de procesar la solicitud
    header("Location: ../vistas/admin/modificar_sede.html");
    exit();
}
?>

