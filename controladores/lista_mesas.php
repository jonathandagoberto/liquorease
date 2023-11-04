<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion) {
    // Consulta para obtener la lista de mesas junto con la información de la sede
    $sql = "SELECT mesas.id, mesas.numero_mesa, mesas.estado, mesas.descripcion, sedes.nombre AS nombre_sede
            FROM mesas
            INNER JOIN sedes ON mesas.sede_id = sedes.id";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["numero_mesa"] . "</td>";
            echo "<td>" . $row["estado"] . "</td>";
            echo "<td>" . $row["descripcion"] . "</td>";
            echo "<td>" . $row["nombre_sede"] . "</td>";
            echo "</tr>";
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
