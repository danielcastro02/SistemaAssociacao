<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Tela/login.php');
}
include_once '../Modelo/usuario.php';

include_once './conexao.php';
