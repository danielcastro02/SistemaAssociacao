<?php
$pontos = "";
if (realpath("./index.php")) {
    $pontos = './';
} else {
    if (realpath("../index.php")) {
        $pontos = '../';
    } else {
        if (realpath("../../index.php")) {
            $pontos = '../../';
        }
    }
}
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['usuario'])) {
    include_once $pontos.'Modelo/usuario.php';
    $usuario = new usuario();
    $usuario = unserialize($_SESSION['usuario']);
    if ($usuario->getAdministrador() == 'true') {
        include_once $pontos.'Base/navAdministrativa.php';
    } else {
            include_once $pontos.'Base/navPadrao.php';
    }
} else {
    include_once $pontos.'Base/navBar.php';
}
