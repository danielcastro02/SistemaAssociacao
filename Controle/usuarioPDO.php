<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./home.php")) {
    include_once "../Controle/conexao.php";
} else {
    include_once "./conexao.php";
}
// fazer a verificação utilizando o realpath para get do cadastroResponsavel -- nota: utilizar temp
$classe = new usuarioPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo();
}

class usuarioPDO {
    public function inserirUsuario() {
        if ($this->validarFormlario()) { //validar estáincompleto
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $senhaMD5 = md5($_POST['senha01']);
            $sql = $pdo->prepare("INSERT INTO usuario values ( default , :nome , :usuario , :senha , "
                    . ":cidade , :bairro , :rua , :numero , :cep , :cpf , :rg , :nascimento, :telefone , :email , "
                    . ":podeLogar , 'false' );");
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
            $sql2 = $this->veririfcarTempResponsavel($sql);
            $sql2->bindValue(':telefone', $_POST['telefone']);
            $sql2->bindValue(':email', $_POST['email']);
            if (isset($_SESSION['id'])) {
                if ($_SESSION['administrador'] == 'true') {
                    $sql2->bindValue(':podeLogar', 'true'); //administrador logado cadastrando aluno TRUE
                } else {
                    $sql2->bindValue(':podeLogar', 'false'); //aluno logado cadastrando o responsável
                }
            } else {
                $sql2->bindValue(':podeLogar', 'false'); //Aluno se cadastrando ou cadastrando Responsável
            }
            if ($sql2->execute()) { //Sucesso ao cadastrar USUÁRIO
                if (isset($_GET['user']) or isset($_SESSION['temp'])) {
                    if ($_GET['user'] == 'aluno') {
                        $this->inserirAluno();
                    }
                    if ($_GET['user'] == 'diretoria') {
                        $this->inserirDiretoria();
                    }
                    if (isset($_SESSION['temp'])&& $_GET['user']=='responsavel') {
                        $this->inserirResponsavel();
                    }
                }
            } else {
                header('location: ../Tela/erroInserirUsuario.php');
            }
        } else {
//nunca vai chegar aqui. O ValidarFormulario vai redirecionar antes erro.
        }
    }
    
    public function inserirDiretoria() {
        if (isset($_POST['cargo']) and $_POST['cargo'] != null) {
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

    public function inserirAluno() {
        if (isset($_POST['curso']) && $_POST['curso'] != null) {
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $id = $this->buscarIDporRG($_POST['rg']);
            $sql = $pdo->prepare("insert into aluno values(:id,null,:curso,0,:conclusao);");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':curso', $_POST['curso']);
            $sql->bindValue(':conclusao', $_POST['conclusao']);
            if ($sql->execute()) {
                $this->enviarOrientacaoCadAluno();
            } else {
                header("Location: ../index.php?msg=erroInserirAlunoMethod");  //MODIFICAR HEADER
            }
        }
    }

    public function enviarOrientacaoCadAluno() { //método de controle
        //$idade = $this->buscarIdade();
        if ($this->buscarIdade($_POST['nascimento']) >= 18) { //Sucesso ao cadastrar ALUNO
            if (isset($_SESSION['id']) and $_SESSION['administrador'] == 'true') {
                header("Location: ../Tela/orientacao.php?msg=sucessoAluno"); //admin - para maior de idade
            } else {
                header("Location: ../Tela/orientacao.php?msg=sucessoAlunoRequerimento"); // requerimento - aluno sem login
            }
        } else {
            $_SESSION['temp'] = $this->buscarIDporRG($_POST['rg']);
            header("location: ../Tela/orientacao.php?msg=cadastrarResponsavel");
        }
    }
    
    public function inserirResponsavel() {
        $con = new conexao();
        $pdo = $con->getConexao();
        $id_respon = $this->buscarIDporRG($_POST['rg']);
        $stmt = $pdo->prepare("update aluno set id_responsavel = :idresponsavel where id_usuario = :iduser ; ");
        $stmt->bindValue(':idresponsavel', $id_respon);
        $stmt->bindValue(':iduser', $_SESSION['temp']);
        if($stmt->execute()){
            header('location: ../Tela/orientacao.php?msg=sucessoAlunoRequerimento');
        }else{
            
        }
    }

    public function veririfcarTempResponsavel($sql) {
        if (isset($_SESSION['temp'])) {
            $idade = $this->buscarIdade($_POST['nascimento']);
            if ($idade >= 18) {
                $sql->bindValue(':nascimento', $_POST['nascimento']);
                return $sql;
            } else {
                header("Location: ../Tela/cadastroResponsavel.php?msg=responsavelMenorDeIdade");
            }
        } else {
            $sql->bindValue(':nascimento', $_POST['nascimento']);
            return $sql;
        }
    }

    public function validarFormlario() {
//verificarCadastroExistente(); //por CPF e RG
        if ($_POST['senha01'] != null and $_POST['senha02'] != null) { //completar
            if ($_POST['senha01'] == $_POST['senha02']) {
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

    public function buscarIDporCPF() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("select id from usuario where cpf = :cpf;");
        $sql->bindValue(':cpf', $_POST['cpf']);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $linha = $sql->fetch(PDO::FETCH_ASSOC);
            $id = $linha['id'];
            return $id;
        } else {
            header("Location: ../index.php?msg=erroBuscarPorCPF");
        }
    }

    public function buscarNomePorCPF() {
        
    }

    public function testeData() { //método criado afim de testes
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
                        $rgtemp = $_SESSION['rg'];
                        session_destroy();
                        session_start();
                        $_SESSION['temp'] = $this->buscarIDporRG($rgtemp);
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
    
    public function logout() {
        session_destroy();
        header('Location: ../index.php');
    }

}
