<?php

function verificarRol($rolPermitido) {
    if (isset($_SESSION['rol']) && $_SESSION['rol'] === $rolPermitido) {
        return true;
    } else {
        return false;
    }
}
?>
