<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!realpath("./index.php")) {
    include_once "../Controle/conexao.php";
    include_once '../Modelo/curso.php';
} else {
    include_once "./Controle/conexao.php";
    include_once './Modelo/curso.php';
}

$classe = new cursoPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}

class cursoPDO {

    public function inserir() {
        $curso = new curso($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("insert into curso values(default, :nome, :turno, :nivel) ;");
        $stmt->bindValue(':nome', $curso->getNome());
        $stmt->bindValue(':turno', $curso->getTurno());
        $stmt->bindValue(':nivel', $curso->getNivel());
        if ($stmt->execute()) {
            header('location: ../Tela/Curso/inserirCurso.php?msg=sucesso');
        } else {
            header('location: ../Tela/Curso/inserirCurso.php?msg=erro');
        }
    }

    public function selectTudo() {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select * from curso;");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectCursoPorId($id) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("SELECT curso FROM aluno WHERE id_usuario = :id");
        $stmt->bindValue(":id", $id);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $linha = $stmt->fetch();
                $aluno = new aluno();
                $aluno->setCurso($linha);
                return $aluno->getCurso();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}