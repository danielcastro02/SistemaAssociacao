<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath("./index.php")) {
    include_once "./Controle/direotiaPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/direotiaPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/direotiaPDO.php";
        }
    }
}
$classe = new direotiaPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo();
}

