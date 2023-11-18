<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion) {
    // Consulta para obtener los productos e información de las mesas de la sede con ID 1
    $sede_id = 1; // ID de la sede que deseas mostrar
    $sql = "SELECT id, nombre_producto, cantidad, sede_id, fecha_vencimiento, precio, estado FROM inventario WHERE sede_id = $sede_id
            UNION
            SELECT id, nombre_producto, cantidad, sede_id, fecha_vencimiento, precio, estado FROM inventario WHERE id_sede = $sede_id";
    
    $result = $conexion->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Imprimir los detalles del producto o mesa
                echo "<tr>";
                echo "<td>" . $row["nombre_producto"] . "</td>";
                echo "<td>" . $row["cantidad"] . "</td>";
                echo "<td>" . $row["sede_id"] . "</td>"; // Cambiado de ubicacion_sede a sede_id
                echo "<td>" . $row["fecha_vencimiento"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
                echo "<td>" . $row["estado"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron productos o mesas en la sede con ID $sede_id.</td></tr>";
        }
    } else {
        echo "No se encontraron mesas en la base de datos.";
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>

