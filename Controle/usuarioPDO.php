<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!realpath("./index.php")) {
    include_once "../Controle/conexao.php";
    include_once '../Modelo/usuario.php';
    include_once '../Modelo/aluno.php';
    include_once '../Modelo/diretoria.php';
} else {
    include_once "./Controle/conexao.php";
    include_once './Modelo/usuario.php';
    include_once './Modelo/aluno.php';
    include_once './Modelo/diretoria.php';
}
// fazer a verificação utilizando o realpath para get do cadastroResponsavel -- nota: utilizar temp
$classe = new usuarioPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo();
}

class usuarioPDO {

    public function inserirUsuario() {
        $us = new usuario($_POST);
        $al = new aluno($_POST);
        $dr = new diretoria($_POST);
        if ($this->validarFormlario($us)) { //validar estáincompleto
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $senhaMD5 = md5($us->getSenha1());
            $sql = $pdo->prepare("INSERT INTO usuario values ( default , :nome , :usuario , :senha , "
                    . ":cidade , :bairro , :rua , :numero , :cep , :cpf , :rg , :nascimento, :telefone , :email , "
                    . ":podeLogar , 'false' );");
            $sql->bindValue(':nome', $us->getNome());
            $sql->bindValue(':usuario', $us->getUsuario());
            $sql->bindValue(':senha', $senhaMD5);
            $sql->bindValue(':cidade', $us->getCidade());
            $sql->bindValue(':bairro', $us->getBairro());
            $sql->bindValue(':rua', $us->getRua());
            $sql->bindValue(':numero', $us->getNumero());
            $sql->bindValue(':cep', $us->getCep());
            $sql->bindValue(':cpf', $us->getCpf());
            $sql->bindValue(':rg', $us->getRg());
            $sql2 = $this->veririfcarTempResponsavel($sql, $us);
            $sql2->bindValue(':telefone', $us->getTelefone());
            $sql2->bindValue(':email', $us->getEmail());
            if (isset($_SESSION['usuario'])) {
                $logado = new usuario(unserialize($_SESSION['usuario']));
                if ($logado->getAdministrador() == 'true') {
                    $sql2->bindValue(':podeLogar', 'true'); //administrador logado cadastrando aluno TRUE
                } else {
                    $sql2->bindValue(':podeLogar', 'false'); //aluno logado cadastrando o responsável
                }
            } else {
                $sql2->bindValue(':podeLogar', 'false'); //Aluno se cadastrando ou cadastrando Responsável
            }
            if ($sql2->execute()) { //Sucesso ao cadastrar USUÁRIO
                if (isset($_GET['user'])) {
                    if ($_GET['user'] == 'aluno') {
                        $this->inserirAluno($al, $us);
                    }
                    if ($_GET['user'] == 'diretoria') {
                        $this->inserirDiretoria($dr);
                    }
                    if (isset($_SESSION['temp']) && $_GET['user'] == 'responsavel') {
                        $this->inserirResponsavel($us);
                    }
                }
            } else {
                header('location: ../Tela/erroInserirUsuario.php');
            }
        } else {
//nunca vai chegar aqui. O ValidarFormulario vai redirecionar antes erro.
        }
    }

    public function inserirDiretoria(diretoria $dr) {
        if (!is_null($dr->getCargo())) {
            $this->abrirConexao();
            $sql = $pdo->prepare("select id from usuario where rg = :rg;");
            $sql->bindValue(':rg', $_POST['rg']);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $linha = $sql->fetch(PDO::FETCH_ASSOC);
                $id = $linha['id'];
                $sql = $pdo->prepare("insert into diretoria values(:id,:cargo);");
                $sql->bindValue(':id', $id);
                $sql->bindValue(':cargo', $_POST['cargo']);
                $sql->execute();
                if ($_SESSION['administrador'] == 'true') {
                    header("Location: ../Tela/orientacaao.php");
                } else {
                    header("Location: ../Tela/orientacao.php");
                }
            }
        } else {
            header("Location: ../index.php?msg=erroInserirDiretoria");
        }
    }

    public function inserirAluno(aluno $al, usuario $us) {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $id = $this->buscarIDporRG($us->getRg());
        $sql = $pdo->prepare("insert into aluno values(:id,null,:curso,0,:conclusao);");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':curso', $al->getCurso());
        $sql->bindValue(':conclusao', $al->getPrevisao_conclusao());
        if ($sql->execute()) {
            $this->enviarOrientacaoCadAluno($us);
        } else {
            header("Location: ../index.php?msg=erroInserirAlunoMethod");  //MODIFICAR HEADER
        }
    }

    public function enviarOrientacaoCadAluno(usuario $us) { //método de controle
        if ($us->getIdade() >= 18) { //Sucesso ao cadastrar ALUNO
            if (isset($_SESSION['usuario'])) {
                $logado = new usuario();
                $logado = $this->getLogado();
                if ($logado->getAdministrador() == 'true') {
                    header("Location: ../Tela/orientacao.php?msg=sucessoAluno"); //admin - para maior de idade
                } else {
                    header("Location: ../Tela/orientacao.php?msg=sucessoAlunoRequerimento"); // requerimento - aluno sem login
                }
            }
        } else {
            $_SESSION['temp'] = $this->buscarIDporRG($us->getRg());
            header("location: ../Tela/orientacao.php?msg=cadastrarResponsavel");
        }
    }

    public function inserirResponsavel(usuario $us) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $id_respon = $this->buscarIDporRG($us->getRg());
        $stmt = $pdo->prepare("update aluno set id_responsavel = :idresponsavel where id_usuario = :iduser ; ");
        $stmt->bindValue(':idresponsavel', $id_respon);
        $stmt->bindValue(':iduser', $_SESSION['temp']);
        unset($_SESSION['temp']);
        if ($stmt->execute()) {
            header('location: ../Tela/orientacao.php?msg=sucessoAlunoRequerimento');
        } else {
            
        }
    }

    public function veririfcarTempResponsavel($sql, usuario $us) {
        if (isset($_SESSION['temp'])) {
            if ($us->getIdade() >= 18) {
                $sql->bindValue(':nascimento', $us->getData_nasc());
                return $sql;
            } else {
                header("Location: ../Tela/cadastroResponsavel.php?msg=responsavelMenorDeIdade");
            }
        } else {
            $sql->bindValue(':nascimento', $us->getData_nasc());
            return $sql;
        }
    }

    public function validarFormlario(usuario $us) {
//verificarCadastroExistente(); //por CPF e RG
        if ($us->getSenha1() != null and $us->getSenha2() != null) { //completar
            if ($us->getSenha1() == $us->getSenha2()) {
                return true;
            } else {
                header('location: ../Tela/cadastroUsuario.php?msg=senhasDiferentes');
            }
        } else {
            header('location: ../Tela/cadastroUsuario.php?msg=senhaVazia');
        }
    }

    public function cancelarCadastroAluno() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
//continuar -- se chegar nessa function com a temp fazer um delete do usuario -- nota: Falar com o Daniel
    }

    public function buscarIDporRG($rg) {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("select id from usuario where rg = :rg;");
        $sql->bindValue(':rg', $rg);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $linha = $sql->fetch(PDO::FETCH_ASSOC);
            $id = $linha['id'];
            return $id;
        } else {
            header("Location: ../index.php?msg=erroBuscarPorRG");
        }
    }

    public function buscarIDporCPF(usuario $us) {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("select id from usuario where cpf = :cpf;");
        $sql->bindValue(':cpf', $us->getCpf());
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $linha = $sql->fetch(PDO::FETCH_ASSOC);
            $id = $linha['id'];
            return $id;
        } else {
            header("Location: ../index.php?msg=erroBuscarPorCPF");
        }
    }

    public function buscarIdade($data_nasc) { // método incompleto - verificar
        $anoAtual = date('Y');
        $mesAtual = date('m');
        $diaAtual = date('d');
        $nascimento = $data_nasc;
        list($ano, $mes, $dia) = explode('-', $nascimento);
        $idade = $anoAtual - $ano;
        if ($mesAtual > $mes) {
            return $idade;
        } else {
            if ($mesAtual == $mes and $diaAtual >= $dia) {
                return $idade;
            } else {
                $idade--;
                return $idade;
            }
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
        $presidente = new usuario($linha);
        return $presidente;
    }

    public function getLogado() {
        $logado = new usuario();
        $logado = unserialize($_SESSION['usuario']);
        return $logado;
    }

    public function update() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $logado = new usuario();
        $logado = $this->getLogado();
        if ($_POST['oldsenha'] == "") {
            header('Location: ../Tela/alterarDadosUsuario.php?msg=senhavazia');
        }
        $senhaantiga = md5($_POST['oldsenha']);
        $stmt = $pdo->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $logado->getId());
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($linha['senha'] == $senhaantiga) {
            $us = new usuario($_POST);
            $us->setId($logado->getId());
            if (($us->getSenha2() == "") && ($us->getSenha1() == "")) {
                $stmt = $pdo->prepare('UPDATE usuario SET nome = :nome, usuario = :usuario, cpf = :cpf, rg = :rg, telefone = :telefone, email = :email WHERE id = :id;');
                $stmt->bindValue(':nome', $us->getNome());
                $stmt->bindValue(':usuario', $us->getUsuario());
                $stmt->bindValue(':cpf', $us->getCpf());
                $stmt->bindValue(':rg', $us->getRg());
                $stmt->bindValue(':telefone', $us->getTelefone());
                $stmt->bindValue(':email', $us->getEmail());
                $stmt->bindValue(':id', $us->getId());

                if ($stmt->execute()) {
                    $logado->atualizar($_POST);
                    $_SESSION['usuario'] = serialize($logado);
                    header('Location: ../Tela/alterarDadosUsuario.php?msg=sucessoss');
                } else {
                    header('Location: ../Tela/alterarDadosUsuario.php?msg=bderross');
                }
            } else {
                if ($us->getSenha2() == $us->getSenha1()) {
                    $senhamd5 = md5($us->getSenha2());
                    $stmt = $pdo->prepare('UPDATE usuario SET nome = :nome, usuario = :usuario, cpf = :cpf, rg = :rg, telefone = :telefone, email = :email, senha = :senha WHERE id = :id;');
                    $stmt->bindValue(':nome', $us->getNome());
                    $stmt->bindValue(':usuario', $us->getUsuario());
                    $stmt->bindValue(':cpf', $us->getCpf());
                    $stmt->bindValue(':rg', $us->getRg());
                    $stmt->bindValue(':telefone', $us->getTelefone());
                    $stmt->bindValue(':email', $us->getEmail());
                    $stmt->bindValue(':senha', $senhamd5);
                    $stmt->bindValue(':id', $us->getId());
                    if ($stmt->execute()) {
                        $logado->atualizar($_POST);
                        $_SESSION['usuario'] = serialize($logado);
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
        $logado = new usuario();
        $logado = $this->getLogado();
        $us = new usuario($_POST);
        $us->setId($logado->getId());
        $senhaantiga = md5($us->getSenha1());
        $stmt = $pdo->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $logado->getId());
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($us->getSenha1() == "") {
            header('Location: ../Tela/alterarEnderecoUsuario.php?msg=senhavazia');
        } else {
            if ($linha['senha'] == $senhaantiga) {
                $stmt = $pdo->prepare('UPDATE usuario SET cidade = :cidade, bairro = :bairro, rua = :rua, numero = :numero, cep = :cep WHERE id = :id;');
                $stmt->bindValue(':cidade', $us->getCidade());
                $stmt->bindValue(':bairro', $us->getBairro());
                $stmt->bindValue(':rua', $us->getRua());
                $stmt->bindValue(':numero', $us->getNumero());
                $stmt->bindValue(':cep', $us->getCep());
                $stmt->bindValue(':id', $us->getId());
                if ($stmt->execute()) {
                    $logado->atualizar($_POST);
                    $_SESSION['usuario'] = serialize($logado);
                    header('Location: ../Tela/alterarEnderecoUsuario.php?msg=sucesso');
                } else {
                    header('Location: ./Tela/alterarEnderecoUsuario.php?msg=bderro');
                }
            } else {
                header('Location: ../Tela/alterarEnderecoUsuario.php?msg=senhaerrada');
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
            $us = new usuario($linha);
            if ($us->getPode_logar() == 'false') {
                header('Location: ../Tela/loginrecusado.php');
            } else {
                $_SESSION['usuario'] = serialize($us);

                $stmt = $pdo->prepare('SELECT * FROM aluno WHERE id_usuario = :id;');
                $stmt->bindValue(':id', $us->getId());
                if ($stmt->execute()) {
                    $l = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($us->getIdade() < 18 && $l['id_responsavel'] == 'null') {
                        $rgtemp = $us->getRg();
                        session_destroy();
                        session_start();
                        $_SESSION['temp'] = $this->buscarIDporRG($rgtemp);
                        header('location: ../Tela/orientacao.php?msg=cadastrarResponsavel');
                    } else {
                        $al = new aluno($l);
                        $_SESSION['aluno'] = serialize($al);
                    }
                    $stmt = $pdo->prepare('SELECT cargo FROM diretoria WHERE id_usuario = :id;');
                    $stmt->bindValue(':id', $us->getId());
                    if ($stmt->execute()) {
                        $s = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['diretoria'] = serialize(new diretoria($s));
                    }
                    header('Location: ../Tela/home.php');
//print_r($_SESSION);
                } else {
                    header("Location: ../Tela/login.php?msg=false");
                }
            }
        } else {
            header("Location: ../Tela/login.php?msg=false");
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../index.php');
    }

}
