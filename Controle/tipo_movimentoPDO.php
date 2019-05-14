
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
$classe = new tipo_movimentoPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}

class tipo_movimentoPDO {
    public function inserir(){
        $tmovimento= new tipo_movimento($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("insert into tipo_movimento values(default, :nome, :tipo);");
        $stmt->bindValue(':nome', $tmovimento->getNome_movimento());
        $stmt->bindValue(':tipo', $tmovimento->getTipo());
        if($stmt->execute()){
            header('location: ../Tela/Cadastro/cadastroTipoMovimento.php?msg=sucesso');
        }else{
            header('location: ../Tela/Cadastro/cadastroTipoMovimento.php?msg=false');
        }
    }
    
    public function selectTudo(){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("SELECT * FROM tipo_movimento;");
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt;
        }else{
            return false;
        }
    }

    public function selectPorID($id_tipo_ref) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("SELECT * FROM tipo_movimento WHERE id_tipo = :id_tipo_ref");
        $stmt->bindValue(":id_tipo_ref", $id_tipo_ref);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

}