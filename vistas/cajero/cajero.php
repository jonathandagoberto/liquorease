<?php
include('../../controladores/verificar_rol.php');
session_start();

if (!verificarRol('cajero')) {
    // El usuario no tiene permisos de cajero, redirige o muestra un mensaje de error
    header('Location: ../../pagina_de_error.php'); // Redirige a una página de error
    exit();
}
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
    </style>
</head>
<body>
    <div class="container">
        <div class="main-title">Bienvenido, Cajero</div>
        <div class="admin-container"> <!-- Contenedor crema -->
            <div class="admin-buttons">
                <div class="row">
                    <div class="col-md-4">
                        <button onclick="generarInformeVentas()" class="btn btn-primary">Generar Informe de Ventas</button>
                    </div>
                    <div class="col-md-4">
                        <button onclick="crearInformeInventario()" class="btn btn-primary">Crear Informe de Inventario</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Gestionar Mesas</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <button type="button" class="btn btn-primary">Gestionar Sedes</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" style="background-color: rgb(220, 228, 249);">
                                <!-- Se eliminó la opción de modificar nombre de sede -->
                                <a class="dropdown-item" href="#" onclick="verSede(1)">Ver Sede 1</a>
                                <a class="dropdown-item" href="#" onclick="verSede(2)">Ver Sede 2</a>
                                <a class="dropdown-item" href="#" onclick="verSede(3)">Ver Sede 3</a>
                                <a class="dropdown-item" href="#" onclick="verSede(4)">Ver Sede 4</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Gestionar Productos</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" style="background-color: rgb(220, 228, 249);">
                                <a class="dropdown-item" href="registro_producto.html" onclick="registrarProducto()">Registrar Producto Nuevo</a>
                                <a class="dropdown-item" href="gestion_producto.html" onclick="listarYEliminarProducto()">Listar y Eliminar Productos</a>
                                <a class="dropdown-item" href="#" onclick="editarProducto()">Editar Productos</a>
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
