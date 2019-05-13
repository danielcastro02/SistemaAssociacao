<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/caixaPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/caixaPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/caixaPDO.php";
            
        }
    }
}
$classe = new caixaPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}