<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/mensalidade.php";
    include_once "./Controle/cobranca_mensalidadePDO.php";
    include_once "./Controle/cobranca_mensalidade.php";
    include_once "./Controle/conexao.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/cobranca_mensalidadePDO.php";
        include_once "../Controle/cobranca_mensalidade.php";
        include_once "../Controle/mensalidade.php";
        include_once "../Controle/conexao.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/cobranca_mensalidadePDO.php";
            include_once "../../Controle/cobranca_mensalidade.php";
            include_once "../../Controle/mensalidade.php";
            include_once "../../Controle/conexao.php";
        }
    }
}

class mensalidadePDO{
    public function registrarMensalidade(){
        $con = new conexao();
        $pdo = $con->getConexao();
        $mensalidade = new mensalidade($_POST);
        $stmt = $pdo->prepare("inseri into mensalidade values (default, :mes , :valor, :vencimento);");
        $stmt->bindValue(':mes', $mensalidade->getMes());
        $stmt->bindValue(':valor', $mensalidade->getValor());
        $stmt->bindValue(':vencimento', $mensalidade)
    }
}

