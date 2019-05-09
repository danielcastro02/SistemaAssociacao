<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/conexao.php";
    include_once './Modelo/caixa.php';
    include_once './Modelo/tipo_movimento.php';
    include_once './Modelo/movimento.php';
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/conexao.php";
        include_once '../Modelo/caixa.php';
        include_once '../Modelo/tipo_movimento.php';
        include_once '../Modelo/movimento.php';
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/conexao.php";
            include_once '../../Modelo/caixa.php';
            include_once '../../Modelo/tipo_movimento.php';
            include_once '../../Modelo/movimento.php';
        }
    }
}
$classe = new caixaPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}

class caixaPDO {
    public function inserir(){
        $caixa= new caixa($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("update caixa set saldo_atual = :saldo where id_caixa = :id");
        $stmt->bindValue(':saldo', $caixa->getSaldo_atual());
        $stmt->bindValue(':id', $caixa->getId_caixa());
        if($stmt->execute()){
            header('location: ../Tela/Cadastro/cadastroCaixa.php?msg=sucesso');
        }else{
            header('location: ../Tela/Cadastro/cadastroCaixa.php?msg=false');
        }
    }
}