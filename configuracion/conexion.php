<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liquorease";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
} else {

}

