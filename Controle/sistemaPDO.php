<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath("./index.php")) {
    include_once "./Controle/conexao.php";
    include_once './Modelo/contato.php';
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/conexao.php";
    include_once '../Modelo/contato.php';
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/conexao.php";
            include_once '../../Modelo/contato.php';
        }
    }
}
$classe = new sistemaPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo();
}

class sistemaPDO {

    function acessoNegado() {
        $contato = new contato($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("insert into acesso_negado values(default, :nome , :cpf , :email , :descricao);");
        $stmt->bindValue(':nome', $contato->getNome());
        $stmt->bindValue(':cpf', $contato->getCpf());
        $stmt->bindValue(':email', $contato->getEmail());
        $stmt->bindValue(':descricao', $contato->getDescricao());
        if ($stmt->execute()) {
            header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoReclamacao');
        } else {
            header('location: ../Tela/Sistema/reclamacao.php?msg=erroReclamacao');
        }
    }

    function contato() {
        $contato = new contato($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("insert into contato values (default, :nome , :cpf , :email ,:motivo , :descricao);");
        $stmt->bindValue(':nome', $contato->getNome());
        $stmt->bindValue(':cpf', $contato->getCpf());
        $stmt->bindValue(':email', $contato->getEmail());
        $stmt->bindValue(':motivo', $contato->getMotivo());
        $stmt->bindValue(':descricao', $contato->getDescricao());
        if ($stmt->execute()) {
            if ($contato->getMotivo() == 'bug') {
                header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoContatoBug');
            }
            if ($contato->getMotivo() == 'critica') {
                header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoContatoCritica');
            }
            if ($contato->getMotivo() == 'sugestao') {
                header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoContatoSugestao');
            }
            if ($contato->getMotivo() == 'problema') {
                header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoContatoProblema');
            }
        } else {
            header('location: ../Tela/Sistema/reclamacao.php?msg=erroContato');
        }
    }

    function selectContatos() {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("SELECT * FROM contato");
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt;
        }else{
            return false;
        }
    }

}
