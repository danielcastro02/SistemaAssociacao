<?php

if (isset($_SESSION['usuario'])) {
    include_once '../Modelo/usuario.php';
    $usuario = new usuario();
    $usuario = unserialize($_SESSION['usuario']);
    if ($usuario->getAdministrador() == 'true') {
        include_once '../Base/navAdministrativa.php"';
    } else {
            include_once '../Base/navPadrao.php';
    }
} else {
    include_once '../Base/navBar.php';
}
