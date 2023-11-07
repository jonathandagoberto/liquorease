<?php
include('../../controladores/verificar_rol.php');
session_start();

if (!verificarRol('cajero')) {
    // El usuario no tiene permisos de cajero, redirige o muestra un mensaje de error
    header('Location: ../../pagina_de_error.php'); // Redirige a una página de error
    exit();
}
// Incluye el archivo de conexión utilizando la ruta relativa
include( '../../configuracion/conexion.php');

// Consulta para obtener la lista de sedes
$sql = "SELECT id, nombre FROM sedes";
$resultado = $conexion->query($sql);

$sedes = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $sedes[] = $fila;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido, Cajero</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../recursos/css/style.css">
    <style>
        body {
            background: url('../../recursos/imagenes/liquorease.jpeg') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            margin-top: 50px;
        }
        .main-title {
            font-size: 2.5rem;
            background: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .admin-container {
            background: #f9e9d8; /* Color crema */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
        }
        .admin-buttons {
            text-align: center;
            margin-top: 20px;
        }
        .admin-buttons .btn {
            margin: 5px;
            background-color: #e84601; /* Color rojo */
            border-color: #e84601; /* Color rojo */
            color: #fff;
            padding: 15px 25px; /* Botones más largos */
        }
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
<a href="../../login.php" class="btn btn-danger btn-lg logout-button" id="salir-button">Salir</a>
<div class="container">
    <div class="main-title">Bienvenido, Cajero</div>
    <div class="admin-container">
        <div class="admin-buttons">
            <div class="row">
                <div class="col-md-4">
                    <button onclick="generarInformeVentas()" class="btn">Generar Informe de Ventas</button>
                </div>
                <div class="col-md-4">
                    <button onclick="crearInformeInventario()" class="btn">Crear Informe de Inventario</button>
                </div>
                <div class="col-md-4">
                    <a href="pedido.html">
                        <button class="btn btn-primary">Tomar Pedido</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="btn-group">
                        <button type="button" class="btn">Gestionar Mesas</button>
                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" style="background-color: rgb(220, 228, 249);">
                            <a class="dropdown-item" href="registromesa.html" onclick="registrarMesas()">Registrar Mesas</a>
                            <a class="dropdown-item" href="listarmesas.html" onclick="listarMesas()">Listar Mesas</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn-group">
                        <button type="button" class="btn">Gestionar Sedes</button>
                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" style="background-color: rgb(220, 228, 249);">
                            <?php foreach ($sedes as $sede) { ?>
                                <a class="dropdown-item" href="#" onclick="verSede(<?php echo $sede['id']; ?>)"><?php echo $sede['nombre']; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn-group">
                        <button type="button" class="btn">Gestionar Productos</button>
                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" style="background-color: rgb(220, 228, 249);">
                            <a class="dropdown-item" href="registro_producto.html" onclick="registrarProducto()">Registrar Producto Nuevo</a>
                            <a class="dropdown-item" href="gestion_producto.html" onclick="listarYEliminarProducto()">Listar y Eliminar Productos</a>
                            <a class="dropdown-item" href="editar_producto.html" onclick="editarProducto()">Editar Productos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
