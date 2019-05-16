<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/mensalidadePDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/mensalidadePDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/mensalidadePDO.php";
        }
    }
}
$classe = new mensalidadePDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}