<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion) {
    // Consulta para obtener la lista de mesas
    $sql = "SELECT id, numero_mesa, estado, descripcion FROM mesas";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["numero_mesa"] . "</td>";
            echo "<td>" . $row["estado"] . "</td>";
            echo "<td>" . $row["descripcion"] . "</td>";
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
