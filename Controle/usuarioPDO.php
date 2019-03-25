<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    //header('Location: ../Tela/login.php');
}

include_once "./conexao.php";

$classe = new usuarioPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET["function"];
    eval("\$classe->\$metodo();");
}

class usuarioPDO {

    public function inserirUsuario() {
        $conexao = new conexao();
        if ($_POST['senha01'] == $_POST['senha02']) {
            echo "method insert user";
// $senhaMD5 = md5($_POST['senha02']);
        } else {
            header("Location: ../Tela/cadastroUsuario.php?msg=senhasdiferentes");
        }
    }

    public function login() {
        $conexao = new conexao();
        $senha = ($_POST['senha']);
        $con = $conexao->getConexao();
        $stmt = $con->prepare('SELECT * FROM usuario WHERE usuario LIKE :usuario AND senha LIKE :senha;');
        $stmt->bindValue(':usuario', $_POST['usuario']);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            if($linha['pode_logar'] == 'false'){
                header('Location: ../Tela/loginrecusado.php');
            }else{
            $_SESSION['id'] = $linha['id'];
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['usuario'] = $linha['usuario'];
            $_SESSION['cidade'] = $linha['cidade'];
            $_SESSION['bairro'] = $linha['bairro'];
            $_SESSION['rua'] = $linha['rua'];
            $_SESSION['numero'] = $linha['numero'];
            $_SESSION['cpf'] = $linha['cpf'];
            $_SESSION['rg'] = $linha['rg'];
            $_SESSION['telefone'] = $linha['telefone'];
            $_SESSION['email'] = $linha['email'];
            header('Location: ../Tela/home.php');
            }
        } else {
            header("Location: ../errrrrou.php");
        }
    }

}

?>
