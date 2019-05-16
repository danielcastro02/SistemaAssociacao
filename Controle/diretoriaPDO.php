<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath("./index.php")) {
    include_once "./Controle/conexao.php";
    include_once "./Controle/usuarioPDO.php";
    include_once './Modelo/diretoria.php';
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/conexao.php";
        include_once "../Controle/usuarioPDO.php";
        include_once '../Modelo/diretoria.php';
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/conexao.php";
            include_once "../../Controle/usuarioPDO.php";
            include_once '../../Modelo/diretoria.php';
        }
    }
}

class diretoriaPDO {

    public function inserirDiretoria() {
        $dr = new diretoria($_POST);
        $usuarioPDO = new usuarioPDO();
        $resposta = $usuarioPDO->inserirUsuario(new usuario($dr));
        try {
            $dr->setIdPessoa($resposta->getIdPessoa());
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $sql = $pdo->prepare("insert into diretoria values(:id,:cargo);");
            $sql->bindValue(':id', $dr->getId_usuario());
            $sql->bindValue(':cargo', $dr->getCargo());
            if ($sql->execute()) {
                header("Location: ../Tela/Cadastro/cadastroDiretoria.php?msg=sucesso");
            }else{
                header("Location: ../Tela/Cadastro/cadastroDiretoria.php?msg=erroInsertDiretoria");
            }
        } catch (Exception $e) {
            header('location: ../Tela/Cadastro/cadastrodiretoria.php?msg=' . $resposta);
        }
    }

}
