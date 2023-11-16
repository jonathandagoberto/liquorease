<?php
// Incluye el archivo de conexión
include(__DIR__ . '/../configuracion/conexion.php');

// Verifica si la conexión se realizó con éxito
if ($conexion) {
    // Consulta para obtener la lista de productos del inventario
    $sql = "SELECT id, nombre_producto, cantidad, ubicacion_sede, precio, estado FROM inventario";
    
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
            $htmlOutput .= "<td>" . htmlspecialchars($row["ubicacion_sede"]) . "</td>";
            $htmlOutput .= "<td>" . htmlspecialchars($row["precio"]) . "</td>";
            $htmlOutput .= "<td>" . htmlspecialchars($row["estado"]) . "</td>";
            $htmlOutput .= "</tr>";
        }

        echo $htmlOutput;
    } else {
        echo "No se encontraron productos en el inventario.";
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
} else {
    echo "Error en la conexión a la base de datos.";
}
?>


// Manejar la solicitud de pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $productosSeleccionados = json_decode($_POST['productosSeleccionados'], true);

    // Validar que se hayan seleccionado productos
    if (!empty($productosSeleccionados)) {
        // Iniciar transacción
        $conexion->begin_transaction();

        try {
            // Recorrer los productos seleccionados
            foreach ($productosSeleccionados as $producto) {
                // Actualizar el inventario restando la cantidad seleccionada
                $updateQuery = "UPDATE inventario SET cantidad = cantidad - ? WHERE id = ?";
                $updateStmt = $conexion->prepare($updateQuery);
                $updateStmt->bind_param('ii', $producto['cantidad'], $producto['id']);
                $updateStmt->execute();

                // Insertar el producto en la tabla de pedidos
                $insertQuery = "INSERT INTO pedidos (id_producto, nombre_producto, cantidad, precio, estado) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = $conexion->prepare($insertQuery);
                $insertStmt->bind_param('issds', $producto['id'], $producto['nombre'], $producto['cantidad'], $producto['precio'], $producto['estado']);
                $insertStmt->execute();
            }

            // Confirmar transacción
            $conexion->commit();

            // Envía una respuesta exitosa
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $conexion->rollback();

            // Envía una respuesta de error
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        // No se seleccionaron productos
        echo json_encode(['success' => false, 'error' => 'No se seleccionaron productos para el pedido.']);
    }
} else {
    // Método no permitido
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
