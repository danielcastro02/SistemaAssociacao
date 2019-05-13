<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath("./index.php")) {
    include_once "./Controle/sistemaPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/sistemaPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/sistemaPDO.php";
        }
    }
}
$classe = new sistemaPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo();
}

