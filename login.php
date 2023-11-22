<?php
session_start();
include('controladores/verificar_rol.php');

if (isset($_SESSION['usuario'])) {
    header('Location: vistas/admin/admin.php');
    exit(); // Agregado para evitar que el código se siga ejecutando después de redirigir
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'configuracion/conexion.php';

    $username = $_POST['Username'];
    $password = $_POST['Password'];

    // Utiliza consultas preparadas para evitar inyección SQL
    $query = "SELECT usuario, contrasena, rol FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            if (password_verify($password, $row['contrasena'])) {
                $horaInicioSesion = date('Y-m-d H:i:s');
                $query = "UPDATE usuarios SET hora_inicio_sesion = ? WHERE usuario = ?";
                $stmt = mysqli_prepare($conexion, $query);
                mysqli_stmt_bind_param($stmt, 'ss', $horaInicioSesion, $username);
                mysqli_stmt_execute($stmt);

                $_SESSION['rol'] = $row['rol'];

                switch ($row['rol']) {
                    case 'administrador':
                        header('Location: vistas/admin/admin.php');
                        exit();
                    case 'cajero':
                        header('Location: vistas/cajero/cajero.php');
                        exit();
                    case 'mesero':
                        header('Location: vistas/mesero/mesero.php');
                        exit();
                    default:
                        echo "Rol no válido. Volver a intentar.";
                        break;
                }
            } else {
                echo "Contraseña incorrecta. Volver a intentar.";
            }
        } else {
            echo "Usuario no encontrado. Volver a intentar.";
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
    <link rel="stylesheet" href="recursos/css/login.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title txt-center">INICIAR SESIÓN</h3>
                    <form method="post" id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-style-agile">
                            <label style="color:#000000;">Usuario</label>
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
                            <label style="color:#e84601;">Contraseña:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1" style="background-color: white">
                                        <span style="color:#e84601" class="fa  fa-unlock-alt"></span>
                                    </span>
                                </div>
                                <input type="password" class="form-control" placeholder="Digitar su clave" aria-label="Password" name="Password" id="txt_pass">
                            </div>
                        </div>
                        <button type="submit" style="background: #e84601; border-top-color: rgb(232, 70, 1); border-bottom-color: (232, 70, 1); border-left-color: rgb(232, 70, 1); border-right-color: rgb(232, 70, 1); color: white;" class="btn btn-warning btn-block btn-lg">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


    <!-- JavaScript para verificar la longitud de la contraseña y cambiar el botón de color -->
    <script src="recursos/js/login.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var passwordInput = document.getElementById('txt_pass');
        var submitButton = document.querySelector('button[type="submit"]');

        passwordInput.addEventListener('input', function() {
            var password = passwordInput.value;

            if (password.length >= 6) {
                submitButton.style.backgroundColor = '#28a745'; // Cambia el color del botón a verde
                submitButton.style.borderColor = '#28a745';
                submitButton.style.color = 'white';
            } else {
                submitButton.style.backgroundColor = '#e84601'; // Cambia el color del botón de vuelta a rojo
                submitButton.style.borderColor = '#e84601';
                submitButton.style.color = 'white';
            }
        });

        document.querySelector('form').addEventListener('submit', function(event) {
            var password = passwordInput.value;

            if (password.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres.');
                event.preventDefault();
            }
        });
    });
</script>
</body>
</html>
