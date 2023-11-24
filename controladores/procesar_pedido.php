<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $id_producto = $_POST['id_producto'];
    $mesa = $_POST['mesa'];
    $sede = $_POST['sede'];
    $cantidad = $_POST['cantidad'];

    // Obtener la información del producto desde la tabla de inventario
    $sql_producto = "SELECT nombre_producto, precio FROM inventario WHERE id = ?";
    
    // Verificar la conexión antes de preparar la consulta
    if ($conexion === null) {
        die("Conexión a la base de datos no establecida.");
    }

    // Preparar la consulta
    $stmt_producto = $conexion->prepare($sql_producto);
    
    if ($stmt_producto === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    // Vincular el parámetro
    $stmt_producto->bind_param("i", $id_producto);

    // Ejecutar la consulta
    $stmt_producto->execute();

    // Obtener los resultados
    $result_producto = $stmt_producto->get_result();

    if ($result_producto->num_rows > 0) {
        // Obtener los datos del producto
        $row_producto = $result_producto->fetch_assoc();
        $nombre_producto = $row_producto['nombre_producto'];
        $precio = $row_producto['precio'];

        // Insertar el pedido en la tabla de pedidos
        $sql_insert_pedido = "INSERT INTO pedidos (nombre_producto, cantidad, precio, estado) 
        VALUES (?, ?, ?, 'pendiente')";
        
        
        // Preparar la consulta de inserción
        $stmt_insert_pedido = $conexion->prepare($sql_insert_pedido);

        if ($stmt_insert_pedido === false) {
            die("Error al preparar la consulta de inserción: " . $conexion->error);
        }

        // Vincular los parámetros
        $stmt_insert_pedido->bind_param("isd", $nombre_producto, $cantidad, $precio);

        // Ejecutar la consulta de inserción
        if ($stmt_insert_pedido->execute()) {
            // Éxito al insertar el pedido
            echo "Pedido procesado con éxito.";

            // Redireccionar a la página pedido.html
            header("Location: ../vistas/mesero/pedido.html");
            exit();
        } else {
            // Error al insertar el pedido
            echo "Error al procesar el pedido.";
        }

        // Cerrar el statement de inserción
        $stmt_insert_pedido->close();
    } else {
        // Producto no encontrado en la tabla de inventario
        echo "Error: Producto no encontrado en la tabla de inventario.";
    }

    // Cerrar el statement de selección
    $stmt_producto->close();

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>
