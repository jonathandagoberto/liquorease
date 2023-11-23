<?php
include(__DIR__ . '/../configuracion/conexion.php');

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Utiliza transacciones para asegurar la consistencia de la base de datos
    mysqli_autocommit($conexion, false);
    
    // Realiza operaciones de cancelación en la base de datos
    $query_insert = "INSERT INTO informe_ventas (nombre_producto, cantidad, precio, fecha_venta)
                     SELECT nombre_producto, cantidad, precio, NOW() FROM pedidos WHERE estado = 'pendiente'";
    
    $query_delete = "DELETE FROM pedidos WHERE estado = 'pendiente'";
    
    $result_insert = mysqli_query($conexion, $query_insert);
    $result_delete = mysqli_query($conexion, $query_delete);

    // Verifica si las consultas fueron exitosas
    if ($result_insert && $result_delete) {
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
