<?php

class teste {

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
                $_SESSION['data_nasc'] = $linha['data_nasc'];
                $_SESSION['administrador'] = $linha['administrador'];

                $stmt = $pdo->prepare('SELECT * FROM aluno WHERE id_usuario = :id;');
                $stmt->bindValue(':id', $_SESSION['id']);
                if ($stmt->execute()) {
                    $l = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($this->buscarIdade($_SESSION['data_nasc']) < 18 && $l['id_responsavel'] == 'null') {
                        session_destroy();
                        session_start();
                        header('location: ../Tela/orientacao.php?msg=cadastrarResponsavel');
                    } else {
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
                } else {
                    header("Location: ../Tela/login.php?msg=false");
                }
            }
        }
    }
}
        