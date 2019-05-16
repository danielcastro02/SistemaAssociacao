<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/alunoPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/alunoPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/alunoPDO.php";
        }
    }
}
$classe = new alunoPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}