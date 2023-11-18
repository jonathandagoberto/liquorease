<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Consulta para obtener la lista de productos disponibles en el inventario
$sql = "SELECT id, nombre_producto, cantidad, sede_id, precio, estado FROM inventario WHERE estado = 'disponible'";

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
        $htmlOutput .= "<td>" . htmlspecialchars($row["sede_id"]) . "</td>"; // Cambiado de ubicacion_sede a sede_id
        $htmlOutput .= "<td>" . htmlspecialchars($row["precio"]) . "</td>";
        $htmlOutput .= "<td>" . htmlspecialchars($row["estado"]) . "</td>";
        $htmlOutput .= "</tr>";
    }

    echo $htmlOutput;

    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtén los datos del formulario
        $producto_id = $_POST["producto_id_mostrar"];
        $nombre_producto = $_POST["nombre_producto"];
        $precio_producto = $_POST["precio_producto"];
        $mesa = $_POST["mesa"];
        $sede = $_POST["sede"];
        $cantidad = $_POST["cantidad"];

        // 1. Inserta el pedido en la tabla pedidos
        $consulta_pedido = "INSERT INTO pedidos (nombre_producto, cantidad, precio) VALUES (?, ?, ?)";
        $stmt_pedido = $conexion->prepare($consulta_pedido);
        $stmt_pedido->bind_param("sid", $nombre_producto, $cantidad, $precio_producto);
        $stmt_pedido->execute();

        // 2. Actualiza la cantidad en la tabla inventario
        $consulta_actualizar_inventario = "UPDATE inventario SET cantidad = cantidad - ? WHERE id = ?";
        $stmt_actualizar_inventario = $conexion->prepare($consulta_actualizar_inventario);
        $stmt_actualizar_inventario->bind_param("ii", $cantidad, $producto_id);
        $stmt_actualizar_inventario->execute();

        // Verifica el resultado de ambas consultas
        if ($stmt_pedido->affected_rows > 0 && $stmt_actualizar_inventario->affected_rows > 0) {
            echo "Pedido realizado con éxito. Inventario actualizado.";
        } else {
            echo "Error al realizar el pedido o actualizar el inventario.";
        }

        // Cierra las declaraciones preparadas
        $stmt_pedido->close();
        $stmt_actualizar_inventario->close();
    }
} else {
    echo "No se encontraron productos disponibles en el inventario.";
}

// Cierra la conexión a la base de datos
$stmt->close();
$conexion->close();
?>
