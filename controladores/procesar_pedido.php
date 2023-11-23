<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST" || True) {
    // Recibir datos del formulario
    $id_producto = $_POST['id_producto'];
    $mesa = $_POST['mesa'];
    $sede = $_POST['sede'];
    $cantidad = $_POST['cantidad'];

    // Imprimir el ID recibido
    echo "ID del producto enviado: $id_producto";

    // Obtener la información del producto desde la tabla de inventario
    $sql_producto = "SELECT nombre_producto, precio FROM inventario WHERE id = $id_producto";
    $result_producto = $conn->query($sql_producto);

    if ($result_producto->num_rows > 0) {
        // Obtener los datos del producto
        $row_producto = $result_producto->fetch_assoc();
        $nombre_producto = $row_producto['nombre_producto'];
        $precio = $row_producto['precio'];

        // Insertar el pedido en la tabla de pedidos
        $sql_insert_pedido = "INSERT INTO pedidos (id_producto, nombre_producto, cantidad, precio) 
                             VALUES ('$id_producto', '$nombre_producto', '$cantidad', '$precio', '$total', '$mesa', '$sede')";

        if ($conn->query($sql_insert_pedido) === TRUE) {
            // Éxito al insertar el pedido
            echo "Pedido procesado con éxito.";
        } else {
            // Error al insertar el pedido
            echo "Error: " . $sql_insert_pedido . "<br>" . $conn->error;
        }
    } else {
        // Producto no encontrado en la tabla de inventario
        echo "Error: Producto no encontrado en la tabla de inventario.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>

