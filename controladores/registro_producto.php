<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $nombre_producto = $_POST["nombre_producto"];
    $cantidad = $_POST["cantidad"];
    $ubicacion_sede = $_POST["ubicacion_sede"];
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];

    // Evita posibles ataques de inyección SQL utilizando sentencias preparadas
    $stmt = $conexion->prepare("INSERT INTO inventario (nombre_producto, cantidad, ubicacion_sede, fecha_vencimiento, precio, descripcion, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre_producto, $cantidad, $ubicacion_sede, $fecha_vencimiento, $precio, $descripcion, $estado);

    if ($stmt->execute()) {
        // Registro exitoso, redirige de nuevo a la página de registro de productos
        header("Location: ../vistas/cajero/registro_producto.html");
        exit();
    } else {
        // Error en el registro
        echo "Error al registrar el producto. Inténtalo de nuevo.";
    }

    // Cierra la conexión a la base de datos
    $stmt->close();
    $conexion->close();
}
?>
