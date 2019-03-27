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
        $senha = md5($_POST['senha']);
        $pdo = $conexao->getConexao();
        $stmt = $pdo->prepare('SELECT * FROM usuario WHERE usuario LIKE :usuario AND senha LIKE :senha;');
        $stmt->bindValue(':usuario', $_POST['usuario']);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($linha['pode_logar'] == 'false') {
                header('Location: ../Tela/loginrecusado.php');
            } else {
                $_SESSION['id'] = $linha['id'];
                $_SESSION['nome'] = $linha['nome'];
                $_SESSION['usuario'] = $linha['usuario'];
                $_SESSION['cidade'] = $linha['cidade'];
                $_SESSION['bairro'] = $linha['bairro'];
                $_SESSION['rua'] = $linha['rua'];
                $_SESSION['numero'] = $linha['numero'];
                $_SESSION['cep'] = $linha['cep'];
                $_SESSION['cpf'] = $linha['cpf'];
                $_SESSION['rg'] = $linha['rg'];
                $_SESSION['telefone'] = $linha['telefone'];
                $_SESSION['email'] = $linha['email'];
                $stmt = $pdo->prepare('SELECT * FROM aluno WHERE id_usuario = :id;');
                $stmt->bindValue(':id', $_SESSION['id']);
                if ($stmt->execute()) {
                    $l = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['id_responsavel'] = $l['id_responsavel'];
                    $_SESSION['data_nasc'] = $l['data_nasc'];
                    $_SESSION['curso'] = $l['curso'];
                    $_SESSION['saldo'] = $l['saldo'];
                    $_SESSION['previsao_conclusao'] = $l['previsao_conclusao'];
                }
                header('Location: ../Tela/home.php');
            }
        } else {
            header("Location: ../errrrrou.php");
        }
    }

    public function update() {
        $conexao = new conexao();
        $con = $conexao->getConexao();

        $senhaantiga = md5($_POST['oldsenha']);
        $stmt = $con->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($linha['senha'] == $senhaantiga) {
            //$senha = md5($_POST['senha']);
            $stmt = $con->prepare('UPDATE usuario SET nome = :nome, usuario = :usuario, cpf = :cpf, rg = :rg, telefone = :telefone, email = :email WHERE id = :id;');
            $stmt->bindValue(':nome', $_POST['nome']);
            $stmt->bindValue(':usuario', $_POST['usuario']);
            $stmt->bindValue(':cpf', $_POST['cpf']);
            $stmt->bindValue(':rg', $_POST['rg']);
            $stmt->bindValue(':telefone', $_POST['telefone']);
            $stmt->bindValue(':email', $_POST['email']);
            $stmt->bindValue(':id', $_SESSION['id']);
            if ($stmt->execute()) {
                $_SESSION['nome'] = $_POST['nome'];
                $_SESSION['usuario'] = $_POST['usuario'];
                $_SESSION['cpf'] = $_POST['cpf'];
                $_SESSION['rg'] = $_POST['rg'];
                $_SESSION['telefone'] = $_POST['telefone'];
                $_SESSION['email'] = $_POST['email'];
            } else {
                header('Location: ../Tela/alterar.php?');
            }
        }
    }

    public function updateEndereco() {
        $conexao = new conexao();
        $con = $conexao->getConexao();

        $senhaantiga = md5($_POST['oldsenha']);
        $stmt = $con->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($linha['senha'] == $senhaantiga) {
            //$senha = md5($_POST['senha']);
            $stmt = $con->prepare('UPDATE usuario SET cidade = :cidade, bairro = :bairro, rua = :rua, numero = :numero, cep = :cep WHERE id = :id;');
            $stmt->bindValue(':cidade', $_POST['cidade']);
            $stmt->bindValue(':bairro', $_POST['bairro']);
            $stmt->bindValue(':rua', $_POST['rua']);
            $stmt->bindValue(':numero', $_POST['numero']);
            $stmt->bindValue(':cep', $_POST['cep']);
            $stmt->bindValue(':id', $_SESSION['id']);
            $stmt->execute();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../index.php');
    }

}

?>
