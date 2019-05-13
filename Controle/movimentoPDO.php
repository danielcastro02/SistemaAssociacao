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
$classe = new movimentoPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}

class movimentoPDO {

    public function inserir() {
        $movimento = new movimento($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $anoAtual = date('Y');
        $mesAtual = date('m');
        $diaAtual = date('d');
        $data = $diaAtual . '/' . $mesAtual . '/' . $anoAtual;
        $stmt = $pdo->prepare('select * from tipo_movimento where id_tipo = :id');
        $stmt->bindValue(':id', $movimento->getId_tipo_ref());
        $stmt->execute();
        $tmovimento = new tipo_movimento($stmt->fetch());
        if ($tmovimento->getTipo() == 'true') {
            $stmt = $pdo->prepare("insert into movimento values"
                    . "(default, :caixa, :tipo, :usuario, :data , :valor, "
                    . "((select saldo_atual from caixa where id_caixa = :id_caixa)+:val));");
        } else {
            $stmt = $pdo->prepare("insert into movimento values"
                    . "(default, :caixa, :tipo, :usuario, :data , :valor, "
                    . "((select saldo_atual from caixa where id_caixa = :id_caixa)-:val));");
        }
        $stmt->bindValue(':caixa', $movimento->getId_caixa_ref());
        $stmt->bindValue(':id_caixa', $movimento->getId_caixa_ref());
        $stmt->bindValue(':tipo', $movimento->getId_tipo_ref());
        $stmt->bindValue(':usuario', $movimento->getId_usuario_ref());
        $stmt->bindValue(':data', $data);
        $stmt->bindValue(':valor', $movimento->getValor());
        $stmt->bindValue(':val', $movimento->getValor());
        $stmt->execute();
        if ($tmovimento->getTipo() == 'true') {
            $stmt = $pdo->prepare('update caixa set saldo_atual = saldo_atual+ :valor where id_caixa = :id');
        } else {
            $stmt = $pdo->prepare('update caixa set saldo_atual = saldo_atual- :valor where id_caixa = :id');
        }
        $stmt->bindValue(':valor', $movimento->getValor());
        $stmt->bindValue(':id', $movimento->getId_caixa_ref());
        if ($stmt->execute()) {
            header('location: ../Tela/Caixa/registroMovimento.php?msg=sucesso');
        } else {
            header('location: ../Tela/Caixa/registroMovimento.php?msg=false');
        }
    }

    public function selectTodasDatas() {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select distinct data_movimento from movimento");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPorData($data) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select * from movimento where data_movimento = :data_movimento");
        $stmt->bindValue(":data_movimento", $data);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
}
