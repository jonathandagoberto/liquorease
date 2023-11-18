<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el ID del producto desde el formulario
    $id = $_POST["id"];

    // Obtén los demás datos del formulario
    $nombre_producto = $_POST["nombre_producto"];
    $cantidad = $_POST["cantidad"];
    $sede_id = $_POST["ubicacion_sede"]; // Cambiado de ubicacion_sede a sede_id
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];
    
    // Verifica que la cantidad no sea mayor que 50
    if ($cantidad > 50) {
        echo "La cantidad no puede ser mayor que 50.";
    } else {
        // Evita posibles ataques de inyección SQL utilizando sentencias preparadas
        $stmt = $conexion->prepare("UPDATE inventario SET nombre_producto = ?, cantidad = ?, sede_id = ?, fecha_vencimiento = ?, precio = ?, descripcion = ?, estado = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $nombre_producto, $cantidad, $sede_id, $fecha_vencimiento, $precio, $descripcion, $estado, $id); // Cambiado de ubicacion_sede a sede_id

        if ($stmt->execute()) {
            // Actualización exitosa, redirige de nuevo a la página de edición o a donde desees
            header("Location: ../vistas/cajero/editar_producto.html");
            exit();
        } else {
            // Error en la actualización
            echo "Error al actualizar el producto. Inténtalo de nuevo.";
        }

        // Cierra la conexión a la base de datos
        $stmt->close();
        $conexion->close();
    }
}
?>





