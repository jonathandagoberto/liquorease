<?php
// Incluye el archivo de conexión utilizando la ruta relativa
include(__DIR__ . '/../configuracion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET["id"])) {
    // Obtén el ID del producto a eliminar desde la solicitud GET
    $id = $_GET["id"];

    // Evita posibles ataques de inyección SQL utilizando sentencias preparadas
    $stmt = $conexion->prepare("DELETE FROM inventario WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Eliminación exitosa

        // Cierra la conexión a la base de datos
        $stmt->close();
        $conexion->close();

        // Redirige a la página actual con un retraso de 1 segundo
        header("Refresh: 1; url=../vistas/cajero/listar_eliminar_productos.html");
    } else {
        // Error en la eliminación
        $response = array(
            'success' => false,
            'message' => 'Error al eliminar el producto. Inténtalo de nuevo.'
        );

        // Devuelve la respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($response);

        // Cierra la conexión a la base de datos
        $stmt->close();
        $conexion->close();
    }
}
?>







