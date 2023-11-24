<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion) {

    // Consulta SQL para obtener el inventario con el ID de sede igual a 4 y el nombre de la sede
    $sql = "SELECT inventario.nombre_producto, inventario.cantidad, inventario.descripcion, inventario.fecha_vencimiento, inventario.precio, inventario.estado, sedes.nombre as nombre_sede
            FROM inventario
            INNER JOIN sedes ON inventario.sede_id = sedes.id
            WHERE inventario.sede_id = 4";

    $result = $conexion->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Poblar la tabla en HTML con los resultados
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nombre_producto"] . "</td>";
            echo "<td>" . $row["cantidad"] . "</td>";
            echo "<td>" . $row["descripcion"] . "</td>";
            echo "<td>" . $row["fecha_vencimiento"] . "</td>";
            echo "<td>" . $row["precio"] . "</td>";
            echo "<td>" . $row["estado"] . "</td>";
            echo "</tr>";
        }
    } else {
        // Si no se encontraron productos en la sede seleccionada
        echo '<tr><td colspan="6">No se encontraron productos en la sede seleccionada.</td></tr>';
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>
