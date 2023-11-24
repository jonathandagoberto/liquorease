<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Utiliza transacciones para asegurar la consistencia de la base de datos
    mysqli_autocommit($conexion, false);
    
    // Realiza operaciones de confirmación en la base de datos
    $query_insert = "INSERT INTO informe_ventas (nombre_producto, cantidad, precio, fecha_venta)
                     SELECT nombre_producto, cantidad, precio, NOW() FROM pedidos WHERE estado = 'pendiente'";
    
    $query_update = "UPDATE pedidos SET estado = 'confirmado' WHERE estado = 'pendiente'";
    
    $result_insert = mysqli_query($conexion, $query_insert);
    $result_update = mysqli_query($conexion, $query_update);

    // Verifica si las consultas fueron exitosas
    if ($result_insert && $result_update) {
        mysqli_commit($conexion);
        $response['success'] = true;
    } else {
        mysqli_rollback($conexion);
        $response['success'] = false;
        $response['error'] = mysqli_error($conexion);
    }

    mysqli_autocommit($conexion, true);

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header('Location: ../pagina_de_error.php');
    exit();
}
?>

