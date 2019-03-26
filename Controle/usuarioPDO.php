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
    eval("\$classe->usarioPDO();");
}

class usuarioPDO {
   
    function usarioPDO() {
        $confirmar = $this->validaFormlario();
        if ($confirmar) {
            $this->inserirAluno();
        } else {
            echo "Erro ao validar";
        }
    }

    public function validaFormlario() {
        if ($_POST['senha01'] === $_POST['senha02']) {
            if ($_POST['senha01'] != null) {
                echo "Senhas okay";
                return true;
            } else {
                echo "senha invalida";
                return false;
                //header("Location: ../Tela/cadastroUsuario.php?msg=invalido");
            }
        } else {
            echo "senhas não conferem";
            return false;
            //header("Location: ../Tela/cadastroUsuario.php?msg=senhasdiferentes");
        }
    }

    public function inserirAluno() {
        echo "estou no inserir aluno;";
        
       // $conexao = new conexao();
        if ($_POST['senha01'] === $_POST['senha02']) {
            // $senhaMD5 = md5($_POST['senha02']);
        } else {
            // header("Location: ../Tela/cadastroUsuario.php?msg = senhasdiferentes");
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
