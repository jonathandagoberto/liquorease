<?php
session_start();
include('controladores/verificar_rol.php');

if (isset($_SESSION['usuario'])) {
    header('Location: vistas/admin/admin.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'configuracion/conexion.php';

    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $rol = $_POST['rol'];

    // Realiza la validación del usuario y contraseña en la base de datos
    $query = "SELECT usuario, contrasena, rol FROM usuarios WHERE usuario = '$username' AND contrasena = '$password'";

    $result = mysqli_query($conexion, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

// Después de validar el usuario y contraseña
if ($row) {
    // Usuario y contraseña válidos

    // Registra la hora de inicio de sesión para el usuario actual
    $horaInicioSesion = date('Y-m-d H:i:s');
    $query = "UPDATE usuarios SET hora_inicio_sesion = '$horaInicioSesion' WHERE usuario = '$username'";
    mysqli_query($conexion, $query);

    // Establece el rol en la sesión
    $_SESSION['rol'] = $row['rol'];

    // Redirige a la página correspondiente según el rol
    if ($row['rol'] === 'administrador') {
        header('Location: vistas/admin/admin.php');
    } elseif ($row['rol'] === 'cajero') {
        header('Location: vistas/cajero/cajero.php');
    } elseif ($row['rol'] === 'mesero') {
        header('Location: vistas/mesero/mesero.php');
    }
} else {
    echo "Usuario y/o contraseña incorrectos. Volver a intentar.";
}

    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE HTML>
<html lang="zxx">
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="recursos/css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        body {
            background: url('recursos/imagenes/liquorease.jpeg') no-repeat center center fixed;
            background-size: cover;
        }
        /* Estilo para el botón de la contraseña */
        .password-button {
        margin-top: 10px;
        width: 30px;
        height: 30px;
        display: inline-block;
        border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title txt-center">INICIAR SESIÓN</h3>
                    <form method="post">
                        <div class="form-style-agile">
                            <label style="color:#000000;">Username</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: white">
                                        <span style="color:#e84601" class="fas fa-user"></span>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Username" name="Username" id="txt_usuario">
                            </div>
                        </div>
                        <div class="form-style-agile">
                        <label style="color:#e84601;">Password</label>
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1" style="background-color: white">
            <span style="color:#e84601" class="fa  fa-unlock-alt"></span>
        </span>
                                </div>
                                <!-- Cambio el input type a text para mostrar el botón verde o rojo -->
                                <input type="password" class="form-control" placeholder="Digitar su clave de 6 dígitos" aria-label="Password" name="Password" id="txt_pass">
                                <!-- Botón para mostrar si la contraseña tiene 6 caracteres -->
                                <span class="password-button" id="password-button"></span>
                            </div>
                        </div>
                        <div class="form-style-agile">
                            <label style="color:#000000;">Rol</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: white">
                                        <span style="color:#e84601" class="fas fa-users"></span>
                                    </span>
                                </div>
                                <select class="form-control" id="rol" name="rol">
                                    <option value="administrador">Administrador</option>
                                    <option value="cajero">Cajero</option>
                                    <option value="mesero">Mesero</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" style="background: #e84601; border-top-color: rgb(232, 70, 1); border-bottom-color: (232, 70, 1); border-left-color: rgb(232, 70, 1); border-right-color: rgb(232, 70, 1); color: white;" class="btn btn-warning btn-block btn-lg">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript para verificar la longitud de la contraseña y cambiar el botón de color -->
    <script>
    const passwordInput = document.getElementById('txt_pass');
    const passwordButton = document.getElementById('password-button');

    passwordInput.addEventListener('input', function() {
        if (passwordInput.value.length === 6) {
            passwordButton.style.backgroundColor = 'green';
        } else {
            passwordButton.style.backgroundColor = 'red';
        }
    });
</script>
</body>
</html>
