<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/conexao.php";
    include_once './Modelo/usuario.php';
    include_once './Modelo/aluno.php';
    include_once './Modelo/diretoria.php';
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/conexao.php";
        include_once '../Modelo/usuario.php';
        include_once '../Modelo/aluno.php';
        include_once '../Modelo/diretoria.php';
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/conexao.php";
            include_once '../../Modelo/caixa.php';
            include_once '../../Modelo/aluno.php';
            include_once '../../Modelo/diretoria.php';
        }
    }
}
$classe = new caixaPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}

class caixaPDO {
    
}