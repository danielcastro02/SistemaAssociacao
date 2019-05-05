<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath("./index.php")) {
    include_once "./Controle/conexao.php";
    include_once './Modelo/curso.php';
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/conexao.php";
        include_once '../Modelo/curso.php';
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/conexao.php";
            include_once '../../Modelo/curso.php';
        }
    }
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
    
    public function selectPorTurno($turno){
        $turno = "%".$turno."%";
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select * from curso where turno like :turno;");
        $stmt->bindValue(":turno", $turno);
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
        $stmt = $pdo->prepare("SELECT * FROM curso WHERE id = :id");
        $stmt->bindValue(":id", $id);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $linha = $stmt->fetch();
                $curso = new curso($linha);
                return $curso;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
