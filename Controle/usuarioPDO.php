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
    //$metodo = "main";
    eval("\$classe->\$main();");
}

class usuarioPDO {

    public function main() {
        //if ($chave == '') {
            $this->validaFormlario();
       // }
    }

    public function validaFormlario() {
        if ($_POST['senha01'] == $_POST['senha02']) {
            if ($_POST['senha01'] != null and $_POST['senha02'] != null) {
                echo "Senhas okay";
            } else {
                echo "senha invalida";
                //header("Location: ../Tela/cadastroUsuario.php?msg=invalido");
            }
        } else {
            echo "senhas não conferem";
            //header("Location: ../Tela/cadastroUsuario.php?msg=senhasdiferentes");
        }
    }

    public function inserirAluno() {
        $this->inserirUsuario();
        $conexao = new conexao();
        if ($_POST['senha01'] == $_POST['senha02']) {
            echo "method insert user";
// $senhaMD5 = md5($_POST['senha02']);
        } else {
            header("Location: ../Tela/cadastroUsuario.php?msg = senhasdiferentes");
        }
    }

    public function login() {
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
            header('Location: ../Tela/home.php');
        } else {
            header("Location: ../errrrrou.php");
        }
    }

}

?>
