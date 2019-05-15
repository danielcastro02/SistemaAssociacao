<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath("./index.php")) {
    include_once "./Controle/cursoPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/cursoPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/cursoPDO.php";
        }
    }
}

$classe = new cursoPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}