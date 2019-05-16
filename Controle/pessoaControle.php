<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath("./index.php")) {
    include_once "./Controle/pessoaPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/pessoaPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/pessoaPDO.php";
        }
    }
}
$classe = new pessoaPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo();
}

