<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Verifica si se ha enviado el ID del producto por POST
if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    // Consulta para obtener los detalles del producto
    $consulta_producto = "SELECT id, nombre_producto, cantidad, sede_id, precio, estado
                         FROM inventario
                         WHERE id = ?";
    
    // Usa consultas preparadas para evitar inyecciones SQL
    $stmt_producto = $conexion->prepare($consulta_producto);
    $stmt_producto->bind_param("i", $producto_id);
    $stmt_producto->execute();
    $result_producto = $stmt_producto->get_result();

    if ($result_producto->num_rows > 0) {
        $producto = $result_producto->fetch_assoc();
        echo json_encode($producto);
    } else {
        echo "No se encontró el producto con ID: " . $producto_id;
    }

    // Cierra la consulta preparada
    $stmt_producto->close();
} else {
    echo "ID de producto no proporcionado.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
