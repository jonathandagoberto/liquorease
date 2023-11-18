<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion) {
    // Consulta para obtener la lista de productos del inventario ordenados por sede
    $sql = "SELECT * FROM inventario ORDER BY sede_id"; // Cambiado de ubicacion_sede a sede_id
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $currentSede = ''; // Variable para mantener el rastreo de la sede actual

        while ($row = $result->fetch_assoc()) {
            // Verificar si la sede ha cambiado
            if ($row["sede_id"] !== $currentSede) { // Cambiado de ubicacion_sede a sede_id
                // Imprimir una fila de encabezado para la nueva sede
                echo "<tr class='table-dark'><td colspan='6'> Id Sede: " . $row["sede_id"] . "</td></tr>"; // Cambiado de ubicacion_sede a sede_id
                $currentSede = $row["sede_id"]; // Cambiado de ubicacion_sede a sede_id
            }

            // Imprimir los detalles del producto
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
        echo "No se encontraron productos en el inventario.";
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>

