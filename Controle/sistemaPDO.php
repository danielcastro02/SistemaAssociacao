<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!realpath("./index.php")) {
    include_once "../Controle/conexao.php";
    include_once '../Modelo/contato.php';
} else {
    include_once "./Controle/conexao.php";
    include_once './Modelo/contato.php';
}
// fazer a verificação utilizando o realpath para get do cadastroResponsavel -- nota: utilizar temp
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
        $stmt->bindValue('nome', $contato->getNome());
        $stmt->bindValue(':cpf', $contato->getCpf());
        $stmt->bindValue(':email', $contato->getEmail());
        $stmt->bindValue(':descricao', $contato->getDescricao());
        if ($stmt->execute()) {
            header('location: ../Tela/reclamacao.php?msg=sucessoReclamacao');
        } else {
            header('location: ../Tela/reclamacao.php?msg=erroReclamacao');
        }
    }

    function contato() {
        $contato = new contato($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("insert into contato values(default, :nome , :cpf , :email ,:motivo , :descricao);");
        $stmt->bindValue('nome', $contato->getNome());
        $stmt->bindValue(':cpf', $contato->getCpf());
        $stmt->bindValue(':email', $contato->getEmail());
        $stmt->bindValue(':motivo', $contato->getMotivo());
        $stmt->bindValue(':descricao', $contato->getDescricao());
        if ($stmt->execute()) {
            if ($contato->getMotivo() == 'bug') {
                header('location: ../Tela/reclamacao.php?msg=sucessoContatoBug');
            }
            if ($contato->getMotivo() == 'critica') {
                header('location: ../Tela/reclamacao.php?msg=sucessoContatoCritica');
            }
            if ($contato->getMotivo() == 'sugestao') {
                header('location: ../Tela/reclamacao.php?msg=sucessoContatoSugestao');
            }
            if ($contato->getMotivo() == 'problema') {
                header('location: ../Tela/reclamacao.php?msg=sucessoContatoProblema');
            }
        } else {
            header('location: ../Tela/reclamacao.php?msg=erroContato');
        }
    }

}
