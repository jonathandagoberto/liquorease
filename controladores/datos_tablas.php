<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Consulta para obtener la lista de productos disponibles en el inventario con el nombre de la sede
$sql = "SELECT inventario.id, inventario.nombre_producto, inventario.cantidad, sedes.nombre as nombre_sede, inventario.precio, inventario.estado
        FROM inventario
        INNER JOIN sedes ON inventario.sede_id = sedes.id
        WHERE inventario.estado = 'disponible'";

// Usa consultas preparadas para evitar inyecciones SQL
$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $htmlOutput = ""; // Variable para almacenar el HTML resultante

    while ($row = $result->fetch_assoc()) {
        $htmlOutput .= "<tr>";
        $htmlOutput .= "<td>" . htmlspecialchars($row["id"]) . "</td>";
        $htmlOutput .= "<td>" . htmlspecialchars($row["nombre_producto"]) . "</td>";
        $htmlOutput .= "<td>" . htmlspecialchars($row["cantidad"]) . "</td>";
        $htmlOutput .= "<td>" . htmlspecialchars($row["nombre_sede"]) . "</td>"; // Cambiado de sede_id a nombre_sede
        $htmlOutput .= "<td>" . htmlspecialchars($row["precio"]) . "</td>";
        $htmlOutput .= "<td>" . htmlspecialchars($row["estado"]) . "</td>";
        $htmlOutput .= "</tr>";
    }

    echo $htmlOutput;
} else {
    echo "No se encontraron productos disponibles en el inventario.";
}

// Cierra la conexión a la base de datos
$stmt->close();
$conexion->close();
?>


