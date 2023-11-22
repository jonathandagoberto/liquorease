<?php
try {
    // Incluye el archivo de conexión
    include(__DIR__ . '/../configuracion/conexion.php');

    // Verifica si la conexión se realizó con éxito
    if ($conexion) {
        // Consulta para obtener las sedes desde la base de datos
        $sql = "SELECT id, nombre FROM sedes";
        $result = $conexion->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar las sedes
            $sedes = array();

            // Recorrer los resultados y agregar cada sede al array
            while ($row = $result->fetch_assoc()) {
                $sedes[] = $row;
            }

            // Devolver las sedes en formato JSON
            echo json_encode($sedes);
        } else {
            // No se encontraron sedes
            echo json_encode(array('error' => "No se encontraron sedes en la base de datos."));
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        // Manejo de errores si la conexión falla
        echo json_encode(array('error' => "Error en la conexión a la base de datos."));
    }
} catch (Exception $e) {
    // Manejo de excepciones generales
    echo json_encode(array('error' => $e->getMessage()));
}
?>






