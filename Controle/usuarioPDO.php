<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./home.php")) {
    include_once "../Controle/conexao.php";
} else {
    include_once "./conexao.php";
}
$classe = new usuarioPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    eval("\$classe->\$metodo();");
}

class usuarioPDO {

    public function validarFormlario() {
        if (!($_POST['senha01'] === $_POST['senha02'])) {
            if ($_POST['senha01'] != null) {
                header('location: ../Tela/cadastroUsuario.php?msg=senhavazia');
            } else {
                header('location: ../Tela/cadastroUsuario.php?msg=senhasdiferentes');
            }
        } else {
            return true;
        }
    }

    public function inserirAluno() {
        if ($this->validarFormlario()) {
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $senhaMD5 = md5($_POST['senha01']);
            $sql = $pdo->prepare("INSERT INTO usuario values ( default , :nome , :usuario , :senha , :cidade , :bairro , :rua , :numero , :cep , :cpf , :rg , :telefone , :email , 'true' , 'false' );");
            $sql->bindValue(':nome', $_POST['nome']);
            $sql->bindValue(':usuario', $_POST['login']);
            $sql->bindValue(':senha', $senhaMD5);
            $sql->bindValue(':cidade', $_POST['cidade']);
            $sql->bindValue(':bairro', $_POST['bairro']);
            $sql->bindValue(':rua', $_POST['rua']);
            $sql->bindValue(':numero', $_POST['numero']);
            $sql->bindValue(':cep', $_POST['cep']);
            $sql->bindValue(':cpf', $_POST['cpf']);
            $sql->bindValue(':rg', $_POST['rg']);
            $sql->bindValue(':telefone', $_POST['telefone']);
            $sql->bindValue(':email', $_POST['email']);
            if ($sql->execute()) {
                header('location: ../Tela/cadastroUsuario.php?msg=sucesso');
            } else {
                header('location: ../Tela/cadastroUsuario.php?msg=bderro');
            }
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
                $_SESSION['administrador'] = $linha['administrador'];

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
                $stmt = $pdo->prepare('SELECT cargo FROM diretoria WHERE id_usuario = :id;');
                $stmt->bindValue(':id', $_SESSION['id']);
                if ($stmt->execute()) {
                    $s = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['cargo'] = $s['cargo'];
                }
                header('Location: ../Tela/home.php');
                //print_r($_SESSION);
            }
        } else {
            header("Location: ../Tela/login.php");
        }
    }

    public function selectPresidente() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $stmt = $pdo->prepare("SELECT id_usuario FROM diretoria WHERE cargo LIKE 'Presidente';");
        $stmt->execute();
        $linha = $stmt->fetch();
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = " . $linha['id_usuario']);
        $stmt->execute();
        $linha = $stmt->fetch();
        return $linha;
    }

    public function update() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        if ($_POST['oldsenha'] == "") {
            header('Location: ../Tela/alterarDadosUsuario.php?msg=senhavazia');
        }
        $senhaantiga = md5($_POST['oldsenha']);
        $stmt = $pdo->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($linha['senha'] == $senhaantiga) {
            if (($_POST['senha2'] == "") && ($_POST['senha2conf'] == "")) {
                $stmt = $pdo->prepare('UPDATE usuario SET nome = :nome, usuario = :usuario, cpf = :cpf, rg = :rg, telefone = :telefone, email = :email WHERE id = :id;');
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
                    header('Location: ../Tela/alterarDadosUsuario.php?msg=sucessoss');
                } else {
                    header('Location: ../Tela/alterarDadosUsuario.php?msg=bderross');
                }
            } else {
                if ($_POST['senha2'] == $_POST['senha2conf']) {
                    $senhamd5 = md5($_POST['senha2']);
                    $stmt = $pdo->prepare('UPDATE usuario SET nome = :nome, usuario = :usuario, cpf = :cpf, rg = :rg, telefone = :telefone, email = :email, senha = :senha WHERE id = :id;');
                    $stmt->bindValue(':nome', $_POST['nome']);
                    $stmt->bindValue(':usuario', $_POST['usuario']);
                    $stmt->bindValue(':cpf', $_POST['cpf']);
                    $stmt->bindValue(':rg', $_POST['rg']);
                    $stmt->bindValue(':telefone', $_POST['telefone']);
                    $stmt->bindValue(':email', $_POST['email']);
                    $stmt->bindValue(':senha', $senhamd5);
                    $stmt->bindValue(':id', $_SESSION['id']);
                    if ($stmt->execute()) {
                        $_SESSION['nome'] = $_POST['nome'];
                        $_SESSION['usuario'] = $_POST['usuario'];
                        $_SESSION['cpf'] = $_POST['cpf'];
                        $_SESSION['rg'] = $_POST['rg'];
                        $_SESSION['telefone'] = $_POST['telefone'];
                        $_SESSION['email'] = $_POST['email'];
                        header('Location: ../Tela/alterarDadosUsuario.php?msg=sucessocs');
                    } else {
                        header('Location: ../Tela/alterarDadosUsuario.php?msg=bderrocs');
                    }
                } else {
                    header('Location: ../Tela/alterarDadosUsuario.php?msg=senhaerrada');
                }
            }
        }
    }

    public function updateEndereco() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();

        $senhaantiga = md5($_POST['senha']);
        $stmt = $pdo->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($_POST['senha'] == "") {
            header('Location: ../Tela/alterarEnderecoUsuario.php?msg=senhavazia');
        } else {
            if ($linha['senha'] == $senhaantiga) {
                $stmt = $pdo->prepare('UPDATE usuario SET cidade = :cidade, bairro = :bairro, rua = :rua, numero = :numero, cep = :cep WHERE id = :id;');
                $stmt->bindValue(':cidade', $_POST['cidade']);
                $stmt->bindValue(':bairro', $_POST['bairro']);
                $stmt->bindValue(':rua', $_POST['rua']);
                $stmt->bindValue(':numero', $_POST['numero']);
                $stmt->bindValue(':cep', $_POST['cep']);
                $stmt->bindValue(':id', $_SESSION['id']);
                if ($stmt->execute()) {
                    $_SESSION['cidade'] = $_POST['cidade'];
                    $_SESSION['bairro'] = $_POST['bairro'];
                    $_SESSION['rua'] = $_POST['rua'];
                    $_SESSION['numero'] = $_POST['numero'];
                    $_SESSION['cep'] = $_POST['cep'];
                    header('Location: ../Tela/alterarEnderecoUsuario.php?msg=sucesso');
                } else {
                    header('Location: ./Tela/alterarEnderecoUsuario.php?msg=bderro');
                }
            } else {
                header('Location: ../Tela/alterarEnderecoUsuario.php?msg=senhaerrada');
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../index.php');
    }

}

?>
