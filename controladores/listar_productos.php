<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

// Realiza la consulta para obtener la lista de productos
$sql = "SELECT * FROM inventario";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Imprime la lista de productos en formato de tabla HTML
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>ID</th><th>Nombre</th><th>Cantidad</th><th>Ubicación Sede</th><th>Fecha Vencimiento</th><th>Precio</th><th>Descripción</th><th>Estado</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["nombre_producto"] . '</td>';
        echo '<td>' . $row["cantidad"] . '</td>';
        echo '<td>' . $row["ubicacion_sede"] . '</td>';
        echo '<td>' . $row["fecha_vencimiento"] . '</td>';
        echo '<td>' . $row["precio"] . '</td>';
        echo '<td>' . $row["descripcion"] . '</td>';
        echo '<td>' . $row["estado"] . '</td>';
        echo '<td><a href="eliminar_producto.php?id=' . $row["id"] . '" class="btn btn-danger">Eliminar</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo "No se encontraron productos en la base de datos.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
