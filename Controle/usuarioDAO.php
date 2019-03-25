<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
}

include_once './conexao.php';
$classe = new usuarioDAO();
if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    eval("\$classe->$metodo");
}

class usuarioDAO{
    public function cadastro(){
        $conexao = new conexao();
        if ($_POST['senha01']==$_POST['senha02']) {
            $senhaMD5 = md5($_POST['senha']);
        }
        
    }
}

?>

