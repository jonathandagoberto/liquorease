<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion) {
    // Consulta para obtener la lista de productos del inventario ordenados por sede
    $sql = "SELECT * FROM inventario ORDER BY ubicacion_sede";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $currentSede = ''; // Variable para mantener el rastreo de la sede actual

        while ($row = $result->fetch_assoc()) {
            // Verificar si la sede ha cambiado
            if ($row["ubicacion_sede"] !== $currentSede) {
                // Imprimir una fila de encabezado para la nueva sede
                echo "<tr class='table-dark'><td colspan='6'>Sede: " . $row["ubicacion_sede"] . "</td></tr>";
                $currentSede = $row["ubicacion_sede"];
            }

            // Imprimir los detalles del producto
            echo "<tr>";
            echo "<td>" . $row["nombre_producto"] . "</td>";
            echo "<td>" . $row["cantidad"] . "</td>";
            echo "<td>" . $row["ubicacion_sede"] . "</td>";
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
