<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

// Recuperar datos del formulario
$id = $_POST['id'];
$nombre_producto = $_POST['nombre_producto'];
$cantidad = $_POST['cantidad'];

// Consultar la información del producto
$query = "SELECT precio, cantidad FROM inventario WHERE id = ? AND nombre_producto = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('ss', $id, $nombre_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Producto no encontrado en el inventario.');
}

$row = $result->fetch_assoc();
$precio_unitario = $row['precio'];
$cantidad_disponible = $row['cantidad'];

if ($cantidad_disponible < $cantidad) {
    die('No hay suficiente cantidad disponible en el inventario.');
}

// Calcular el costo total
$costo_total = $precio_unitario * $cantidad;

// Actualizar la cantidad en el inventario
$nueva_cantidad = $cantidad_disponible - $cantidad;
$query = "UPDATE inventario SET cantidad = ? WHERE id = ? AND nombre_producto = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('iss', $nueva_cantidad, $id, $nombre_producto);
$stmt->execute();

// Registrar el pedido (guardar en una tabla de pedidos, si es necesario)

// Mostrar el resultado al usuario
echo "Pedido registrado exitosamente. Costo total: $costo_total";

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
