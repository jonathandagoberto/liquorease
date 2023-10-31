<?php
// Incluir la conexión a la base de datos desde el archivo conexion.php
include('../configuracion/conexion.php');


// Verificar si se ha enviado un formulario
if (isset($_POST['accion']) && $_POST['accion'] === 'tomar_pedido') {
    // Recuperar los datos del formulario
    $cantidades = array(); // Un arreglo para almacenar las cantidades por trago

    // Recoger los datos de los seis tragos
    $cantidad1 = $_POST['cantidad1'];
    $cantidad2 = $_POST['cantidad2'];
    $cantidad3 = $_POST['cantidad3'];
    $cantidad4 = $_POST['cantidad4'];
    $cantidad5 = $_POST['cantidad5'];
    $cantidad6 = $_POST['cantidad6'];

    for ($i = 1; $i <= 6; $i++) {
        $trago = $_POST['trago' . $i];
        $cantidad = $_POST['cantidad' . $i];

        if (!empty($trago) && !empty($cantidad) && is_numeric($cantidad) && $cantidad > 0) {
            // Verificar si hay suficientes existencias del trago en la base de datos
            $query = "SELECT cantidad FROM inventario WHERE id = $trago";
            $result = mysqli_query($conexion, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $existencias = $row['cantidad'];

                if ($cantidad <= $existencias) {
                    $cantidades[$trago] = $cantidad; // Almacenar la cantidad
                } else {
                    echo "No hay suficientes existencias de Trago $trago.";
                }
            } else {
                echo "Trago $trago no encontrado en la base de datos.";
            }
        }
    }

    // Procesar los tragos con cantidades válidas
    if (!empty($cantidades)) {
        // Realizar el procesamiento necesario con los tragos y cantidades válidas
        // Esto puede incluir la actualización del estado del inventario y la creación de un pedido
        // Tu lógica de negocio irá aquí

        // Ejemplo: Actualizar el estado de los tragos a "en proceso" en la base de datos
        foreach ($cantidades as $trago => $cantidad) {
            $query = "UPDATE inventario SET estado = 'en proceso' WHERE id = $trago";
            mysqli_query($conexion, $query);
        }

        echo "Pedido tomado exitosamente.";
    // Redirigir a mesero.php después de un breve retraso
    header("refresh:5;url=mesero.php"); // Cambia 'mesero.php' a la página a la que desees redirigir
    exit;


    }
}

// Cierra la conexión a la base de datos al final del archivo si es necesario

?>
