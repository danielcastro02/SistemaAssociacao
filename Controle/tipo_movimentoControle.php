<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/tipo_movimentoPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/tipo_movimentoPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/tipo_movimentoPDO.php";
        }
    }
}
$classe = new tipo_movimentoPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}
