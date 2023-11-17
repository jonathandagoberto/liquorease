<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la solicitud es mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Realiza operaciones de cancelación en la base de datos
    $query = "INSERT INTO informe_ventas (nombre_producto, cantidad, precio, fecha_venta)
              SELECT nombre_producto, cantidad, precio, NOW() FROM pedidos WHERE estado = 'pendiente'";
    
    $query_delete = "DELETE FROM pedidos WHERE estado = 'pendiente'";
    
    // Ejecuta las consultas
    $result_insert = mysqli_query($conexion, $query);
    $result_delete = mysqli_query($conexion, $query_delete);

    // Verifica si las consultas fueron exitosas
    if ($result_insert && $result_delete) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = mysqli_error($conexion);
    }

    // Devuelve la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si la solicitud no es mediante el método POST, redirige o maneja el error de acuerdo a tus necesidades
    header('Location: ../pagina_de_error.php');
    exit();
}
?>
