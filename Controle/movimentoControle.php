<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/movimentoPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/movimentoPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/movimentoPDO.php";
        }
    }
}
$classe = new movimentoPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}
