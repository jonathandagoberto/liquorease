<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido, Mesero</title>
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
        <div class="main-title">Bienvenido, Mesero</div>
        <div class="admin-container"> <!-- Contenedor crema -->
            <div class="admin-buttons">
                <div class="row">
                    <div class="col-md-4">
                        <button onclick="tomarPedidoClientes()" class="btn btn-primary">Tomar Pedido de Clientes</button>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Gestionar Pedido</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" style="background-color: rgb(220, 228, 249);">
                                <a class="dropdown-item" href="#" onclick="validarPedido()">Validar Pedido</a>
                                <a class="dropdown-item" href="#" onclick="confirmarProductos()">Confirmar Productos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tomarPedidoClientes() {
            // Agrega aquí la lógica para tomar pedidos de clientes
        }

        function validarPedido() {
            // Agrega aquí la lógica para validar un pedido
        }

        function confirmarProductos() {
            // Agrega aquí la lógica para confirmar productos en el pedido
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
