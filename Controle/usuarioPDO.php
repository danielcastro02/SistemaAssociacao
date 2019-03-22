<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once "./conexao.php";
$classe = new usuarioPDO();
if (isset($_GET['function'])) {
    $metodo = $_GET["function"];
    eval("\$classe->\$metodo();");
}

class usuarioPDO{
    
    public function login(){
        $conexao = new conexao();
        $senha = md5($_POST['senha']);
        $con = $conexao->getConexao();
        $stmt = $con->prepare('SELECT * FROM usuario WHERE usuario LIKE :usuario AND senha LIKE :senha;');
        $stmt->bindValue(':usuario', $_POST['usuario']);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $linha['id'];
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['usuario'] = $linha['usuario'];
            header('location: ../Tela/home.php');
        } else {
            header("Location: ../index.php?msg=false");
        }
    }
}

?>
