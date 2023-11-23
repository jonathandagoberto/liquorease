<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener los pedidos
$sql = "SELECT * FROM pedidos";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // Construir la tabla de pedidos
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['nombre_producto'] . "</td>";
        echo "<td>" . $fila['cantidad'] . "</td>";
        echo "<td>" . $fila['precio'] . "</td>";
        echo "<td>" . $fila['estado'] . "</td>";
        echo "</tr>";
    }
} else {
    echo '<tr><td colspan="5">No se encontraron pedidos en la base de datos.</td></tr>';
}

$conexion->close();
?>
