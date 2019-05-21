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


class sistemaPDO {

    function acessoNegado() {
        $contato = new contato($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("insert into acesso_negado values(default, :nome , :cpf , :email , :descricao);");
        $stmt->bindValue(':nome', $contato->getNome());
        $stmt->bindValue(':cpf', $contato->getCpfCnpj());
        $stmt->bindValue(':email', $contato->getEmail());
        $stmt->bindValue(':descricao', $contato->getDescricao());
        if ($stmt->execute()) {
            header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoReclamacao');
        } else {
            header('location: ../Tela/Sistema/reclamacao.php?msg=erroReclamacao');
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
