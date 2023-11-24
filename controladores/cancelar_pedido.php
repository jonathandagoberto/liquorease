<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtén los detalles del pedido desde la tabla pedidos
        $query = "SELECT id, nombre_producto, cantidad FROM pedidos WHERE estado = 'pendiente'";
        $result = $conexion->query($query);

        // Mueve los productos cancelados a la tabla inventario
        while ($row = $result->fetch_assoc()) {
            $idPedido = $row['id'];
            $nombreProducto = $row['nombre_producto'];
            $cantidad = $row['cantidad'];

            // Actualiza la cantidad en la tabla inventario
            $updateInventarioQuery = "UPDATE inventario SET cantidad = cantidad + $cantidad WHERE nombre_producto = '$nombreProducto'";
            $conexion->query($updateInventarioQuery);
        }

        // Borra los registros de la tabla pedidos
        $deletePedidosQuery = "DELETE FROM pedidos WHERE estado = 'pendiente'";
        $conexion->query($deletePedidosQuery);

        // Responde con éxito
        $response = array('success' => true);
        echo json_encode($response);
    } catch (Exception $e) {
        // Maneja errores
        $response = array('success' => false, 'error' => $e->getMessage());
        echo json_encode($response);
    }
} else {
    // Si no es una solicitud POST, redirige o muestra un mensaje de error
    header('Location: ../../pagina_de_error.php');
    exit();
}
?>
