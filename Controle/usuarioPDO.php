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
// fazer a verificaÃ§Ã£o utilizando o realpath para get do cadastroResponsavel -- nota: utilizar temp
$classe = new usuarioPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}

class usuarioPDO {

    public function pesquisarUsuariosPorNome($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        if ($pesquisa != null) {

            $sql = $PDO->prepare("SELECT * FROM usuario WHERE nome like :pesquisa;");
            $sql->bindValue(':pesquisa', $pesquisa);
        } else {
            $sql = $PDO->prepare("SELECT * FROM usuario;");
        }
        if ($sql->execute()) {
            if ($sql->rowCount() > 0) {
                return $sql;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function pesquisarUsuariosPorCPF($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        if (isset($_GET['cpf'])) {
            $pesquisa = $_GET['cpf'];
        }
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE cpf like :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->execute()) {
            if ($sql->rowCount() > 0) {
                return $sql;
            } else {
                echo 'false';
                return false;
            }
        } else {
            echo 'false';
            return false;
        }
    }

    public function pesquisarUsuariosPorRG($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        if (isset($_GET['rg'])) {
            $pesquisa = $_GET['rg'];
        }
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE rg like :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function pesquisarPorCPFExata($pesquisa) {
        if (isset($_GET['cpf'])) {
            $pesquisa = $_GET['cpf'];
        }
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE cpf = :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function pesquisarPorRGExata($pesquisa) {
        if (isset($_GET['rg'])) {
            $pesquisa = $_GET['rg'];
        }
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE rg = :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function pesquisarUsuariosInativos($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE pode_logar = 'false' and nome like :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function pesquisarUsuariosAdministradores($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE administrador = 'true' and nome like :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function pesquisarUsuariosAtivos($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE pode_logar = 'true' and nome like :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function pesquisarUsuariosAluno($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario u INNER JOIN aluno a ON u.id=a.id_usuario WHERE nome like :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function pesquisarUsuariosPorCurso($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario u INNER JOIN aluno a ON u.id=a.id_usuario WHERE curso like :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function pesquisarUsuariosDaDiretoria($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario u INNER JOIN diretoria d ON u.id=d.id_usuario WHERE cargo like :pesquisa;");
        $sql->bindValue(':pesquisa', $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function pesquisarUsuariosPorUsuario($pesquisa) {
        if (isset($_GET['usuario'])) {
            $pesquisa = $_GET['usuario'];
        }
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $pesquisa = "%" . $pesquisa . "%";
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE usuario like :pesquisa;");
        $sql->bindValue(":pesquisa", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function pesquisarUsuariosPorEmail($pesquisa) {
        if (isset($_GET['email'])) {
            $pesquisa = $_GET['email'];
        }
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $pesquisa = "%" . $pesquisa . "%";
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE email like :pesquisa;");
        $sql->bindValue(":pesquisa", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function pesquisarPorUsuarioExata($pesquisa) {
        if (isset($_GET['usuario'])) {
            $pesquisa = $_GET['usuario'];
        }
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE usuario = :pesquisa;");
        $sql->bindValue(":pesquisa", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function pesquisarPorEmailExata($pesquisa) {
        if (isset($_GET['email'])) {
            $pesquisa = $_GET['email'];
        }
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("SELECT * FROM usuario WHERE email = :pesquisa;");
        $sql->bindValue(":pesquisa", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function validaCpf($cpf) {
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        if (strlen($cpf) != 11) {
            return false;
        } else {
            if ($cpf == '11111111111' ||
                    $cpf == '22222222222' ||
                    $cpf == '33333333333' ||
                    $cpf == '44444444444' ||
                    $cpf == '55555555555' ||
                    $cpf == '66666666666' ||
                    $cpf == '77777777777' ||
                    $cpf == '88888888888' ||
                    $cpf == '99999999999' ||
                    $cpf == '00000000000') {
                return false;
            } else {
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf{$c} * (($t + 1) - $c);
                    }
                    $d = ((10 + $d) % 11) % 10;
                    if ($cpf{$c} != $d) {
                        return false;
                    }
                }
                return true;
            }
        }

        return true;
    }

    public function verificarExistencia(usuario $us) {
        if ($this->pesquisarPorRGExata($us->getRg())) {
            echo 'rg';
            return true;
        }
        if ($this->pesquisarPorCPFExata($us->getCpf())) {
            echo 'cpf';
            return true;
        }
        if ($this->pesquisarPorEmailExata($us->getEmail())) {
            echo 'email';
            return true;
        }
        if ($this->pesquisarPorUsuarioExata($us->getUsuario())) {
            echo 'user';
            return true;
        }
        return false;
    }

//    public function inserirUsuario() {
//        $us = new usuario($_POST);
//        if ($this->verificarExistencia($us)) {
//            header("location: ../Tela/erroInterno.php");
//        } else {
//            if(!$this->validaCpf($us->getCpf())){
//                header('location: ../Tela/cadastroAluno.php');
//            }
//            $al = new aluno($_POST);
//            $dr = new diretoria($_POST);
//            if ($this->validarFormlario($us)) { //validar estÃ¡incompleto
//                $conexao = new conexao();
//                $pdo = $conexao->getConexao();
//                $senhaMD5 = md5($us->getSenha1());
//                $sql = $pdo->prepare("INSERT INTO usuario values ( default , :nome , :usuario , :senha , "
//                        . ":cidade , :bairro , :rua , :numero , :cep , :cpf , :rg , :nascimento, :telefone , :email , :fotoPerfil , "
//                        . ":podeLogar , 'false' );");
//                $sql->bindValue(':nome', $us->getNome());
//                $sql->bindValue(':usuario', $us->getUsuario());
//                $sql->bindValue(':senha', $senhaMD5);
//                $sql->bindValue(':cidade', $us->getCidade());
//                $sql->bindValue(':bairro', $us->getBairro());
//                $sql->bindValue(':rua', $us->getRua());
//                $sql->bindValue(':numero', $us->getNumero());
//                $sql->bindValue(':cep', $us->getCep());
//                $sql->bindValue(':cpf', $us->getCpf());
//                $sql->bindValue(':rg', $us->getRg());
//                $sql = $this->veririfcarTempResponsavel($sql, $us);
//                $sql->bindValue(':telefone', $us->getTelefone());
//                $sql->bindValue(':email', $us->getEmail());
//                $sql->bindValue(':fotoPerfil', '../Img/user_icon.png');
//                if (isset($_SESSION['usuario'])) {
//                    $logado = new usuario(unserialize($_SESSION['usuario']));
//                    if ($logado->getAdministrador() == 'true') {
//                        $sql->bindValue(':podeLogar', 'true'); //administrador logado cadastrando aluno TRUE
//                    } else {
//
//                        $sql->bindValue(':podeLogar', 'false'); //aluno logado cadastrando o responsável
//                    }
//                } else {
//                    $sql->bindValue(':podeLogar', 'false'); //Aluno se cadastrando ou cadastrando Responsável
//                }
//                if ($sql->execute()) { //Sucesso ao cadastrar USUÁRIO
//                    if (isset($_GET['user'])) {
//                        if ($_GET['user'] == 'aluno') {
//                            $this->inserirAluno($al, $us);
//                        }
//                        if ($_GET['user'] == 'diretoria') {
//                            $this->inserirDiretoria($dr);
//                        }
//                        if (isset($_SESSION['temp']) && $_GET['user'] == 'responsavel') {
//                            $this->inserirResponsavel($us);
//                        }
//                    }
//                } else {
//                    header('location: ../Tela/erroInserirUsuario.php');
//                }
//            } else {
////nunca vai chegar aqui. O ValidarFormulario vai redirecionar antes erro.
//            }
//        }
//    }

    public function inserirDiretoria() {
        $us = new usuario($_POST);
        $dr = new diretoria($_POST);
        $resposta = $this->inserirUsuario($us);
        if ($resposta == 'true') {
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $sql = $pdo->prepare("select id from usuario where rg = :rg;");
            $sql->bindValue(':rg', $us->getRg());
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $linha = $sql->fetch(PDO::FETCH_ASSOC);
                $dr->setId_usuario($linha['id']);
                $sql = $pdo->prepare("insert into diretoria values(:id,:cargo);");
                $sql->bindValue(':id', $dr->getId_usuario());
                $sql->bindValue(':cargo', $dr->getCargo());
                $sql->execute();
                header("Location: ../Tela/cadastroDiretoria.php?msg=sucesso");
            } else {
                header("Location: ../Tela/cadastroDiretoria.php?msg=erroInserirDiretoria");
            }
        } else {
            header('location: ../Tela/cadastrodiretoria.php?msg=' . $resposta);
        }
    }

    public function inserirUsuario(usuario $us) {
        $validacao = $this->validarFormlario($us);
        if ($validacao == 'true') { //validar estáincompleto
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $senhaMD5 = md5($us->getSenha1());
            $sql = $pdo->prepare("INSERT INTO usuario values ( default , :nome , :usuario , :senha , "
                    . ":cidade , :bairro , :rua , :numero , :cep , :cpf , :rg , :nascimento, :telefone , :email , :fotoPerfil , "
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
            $sql->bindValue(':nascimento', $us->getData_nasc());
            //$sql = $this->veririfcarTempResponsavel($sql, $us); A principio não é mais necessário
            $sql->bindValue(':telefone', $us->getTelefone());
            $sql->bindValue(':email', $us->getEmail());
            $sql->bindValue(':fotoPerfil', '../Img/user_icon.png');
            $sql = $this->verificaPodeLogar($sql);
            if ($sql->execute()) { //Sucesso ao cadastrar USUÁRIO
                return true;
            } else {
                return 'erroInsertUsuario';
            }
        } else {
            return $validacao;
        }
    }

    public function verificaPodeLogar(PDOStatement $sql) {
        if (isset($_SESSION['usuario'])) {
            $logado = new usuario(unserialize($_SESSION['usuario']));
            if ($logado->getAdministrador() == 'true') {
                $sql->bindValue(':podeLogar', 'true'); //administrador logado cadastrando aluno TRUE
            } else {

                $sql->bindValue(':podeLogar', 'false'); //aluno logado cadastrando o responsável
            }
        } else {
            $sql->bindValue(':podeLogar', 'false'); //Aluno se cadastrando ou cadastrando Responsável
        }
        return $sql;
    }

    public function inserirAluno() {
        $us = new usuario($_POST);
        $al = new usuario($_POST);
        $resultado = $this->inserirUsuario($us);
        if ($resultado == 'true') {
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $us->setId($this->buscarIDporRG($us->getRg()));
            $sql = $pdo->prepare("insert into aluno values(:id,null,:curso,0,:conclusao);");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':curso', $al->getCurso());
            $sql->bindValue(':conclusao', $al->getPrevisao_conclusao());
            if ($sql->execute()) {
                header("Location: ../Tela/orientacao.php?msg=" . $this->enviarOrientacaoCadAluno($us));
            } else {
                header("Location: ../Tela/cadastroAluno.php?msg=erroInserirAluno");
            }
        } else {
            header('location: ../Tela/cadastroAluno.php?msg=' . $resultado);
        }
    }


    private function enviarOrientacaoCadAluno(usuario $us) { //mÃ©todo de controle
        if ($us->getIdade() >= 18) { //Sucesso ao cadastrar ALUNO
            if (isset($_SESSION['usuario'])) {
                $logado = new usuario($this->getLogado());
                if ($logado->getAdministrador() == 'true') {
                    return "sucessoAluno"; //admin - para maior de idade
                } else {
                    return "sucessoAlunoRequerimento";
                }
            } else {
                return "sucessoAlunoRequerimento"; // requerimento - aluno sem login
            }
        } else {
            $_SESSION['temp'] = $us->getId();
            return "cadastrarResponsavel";
        }
    }

    public function inserirResponsavel() {
        $us = new usuario($_POST);
        $resposta = $this->inserirUsuario($us);
        if ($resposta == 'true') {
            $con = new conexao();
            $pdo = $con->getConexao();
            $us->setId($this->buscarIDporRG($us->getRg()));
            $stmt = $pdo->prepare("update aluno set id_responsavel = :idresponsavel where id_usuario = :iduser ; ");
            $stmt->bindValue(':idresponsavel', $us->getId());
            $stmt->bindValue(':iduser', $_SESSION['temp']);
            $id = $_SESSION['temp'];
            unset($_SESSION['temp']);
            if ($stmt->execute()) {
                header('location: ../Tela/orientacao.php?msg='.$this->enviarOrientacaoCadAluno($this->selectAlunoPorId($id)));
            } else {
                header('location: ../Tela/cadastroResponsavel.php?msg=erroInsert');
            }
        }else{
            header('location: ../Tela/cadastroResponsavel.php?msg='.$resposta);
        }
    }

    public function buscarFilhos($id) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select * from aluno where id_responsavel = :id;");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
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
        if ($us->getSenha1() != null and $us->getSenha2() != null) { //completar
            if ($us->getSenha1() == $us->getSenha2()) {
                if ($this->validaCpf($us->getCpf())) {
                    if ($this->verificarExistencia($us)) {
                        return true;
                    } else {
                        return 'dadosJaExistem';
                    }
                } else {
                    return 'cpfInvalidos';
                }
            } else {
                return 'senhasNaoCoincidem';
            }
        } else {
            return 'senhaVazia';
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

    public function buscarIdade($data_nasc) { // mÃ©todo incompleto - verificar
        $anoAtual = date('Y');
        $mesAtual = date('m');
        $diaAtual = date('d');
        $nascimento = $data_nasc;
        list($ano, $mes, $dia) = explode('/', $nascimento);
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

    public function litarUsuarios() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("SELECT * FROM usuario;");
        $sql->execute();
        return $sql;
    }

    public function tornarUsuarioInativo() {
        $id = $_GET['id'];
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("UPDATE usuario SET pode_logar = 'false' where id = :id ;");
        $sql->bindValue(':id', $id);
        if ($sql->execute()) {
            //return $sql;
            header("Location: ../Tela/listarUsuario.php");
        } else {
            header("Location: ../Tela/listarUsuario.php");
        }
    }

    public function tornarUsuarioAtivo() {
        $id = $_GET['id'];
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("UPDATE usuario SET pode_logar = 'true' where id = :id ;");
        $sql->bindValue(':id', $id);
        if ($sql->execute()) {
            //return $sql;
            header("Location: ../Tela/listarUsuario.php");
        } else {
            header("Location: ../Tela/listarUsuario.php");
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
        if (isset($_SESSION['usuario'])) {
            $logado = new usuario(unserialize($_SESSION['usuario']));
            return $logado;
        } else {
            return false;
        }
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

    public function updateAluno() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $logado = new usuario();
        $aluno = new aluno();
        $aluno = unserialize($_SESSION['aluno']);
        $logado = $this->getLogado();
        $al = new aluno($_POST);
        $al->setId_usuario($logado->getId());
        $senhaantiga = md5($al->getSenha1());
        $stmt = $pdo->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $logado->getId());
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($al->getSenha1() == "") {
            header('Location: ../Tela/alterarAluno.php?msg=senhavazia');
        } else {
            if ($linha['senha'] == $senhaantiga) {
                $stmt = $pdo->prepare('UPDATE aluno SET curso = :curso, previsao_conclusao = :previsao_conclusao WHERE id_usuario = :id;');
                $stmt->bindValue(':curso', $aluno->getCurso());
                $stmt->bindValue(':previsao_conclusao', $aluno->getPrevisao_conclusao());
                $stmt->bindValue(':id', $al->getId_usuario());
                if ($stmt->execute()) {
                    $logado->atualizar($_POST);
                    $_SESSION['usuario'] = serialize($logado);
                    header('Location: ../Tela/alterarAluno.php?msg=sucesso');
                } else {
                    header('Location: ./Tela/alterarAluno.php?msg=bderro');
                }
            } else {
                header('Location: ../Tela/alterarAluno.php?msg=senhaerrada');
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
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
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
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $s = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['diretoria'] = serialize(new diretoria($s));
                    }
                }
                header('Location: ../Tela/home.php');
            }
        } else {
            header("Location: ../Tela/login.php?msg=false");
        }
    }

    public function selectUsuarioPorId($id) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select * from usuario where id = :id;");
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $linha = $stmt->fetch();
                return $usuario = new usuario($linha);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function selectAlunoPorId($id) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select * from aluno where id_usuario = :id;");
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $linha = $stmt->fetch();
                return $aluno = new aluno($linha);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function selectDiretoriaPorId($id) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select * from diretoria where id_usuario = :id;");
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $linha = $stmt->fetch();
                return $diretoria = new diretoria($linha);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function alteraFoto() {
        $us = new usuario();
        $us = unserialize($_SESSION['usuario']);
        $SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
        if ($SendCadImg) {
            //Receber os dados do formulÃ¡rio
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $nome_imagem = md5($us->getId());
            //Inserir no BD
            $ext = explode('.', $_FILES['imagem']['name']);
            $extensao = "." . $ext[1];
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $stmt = $pdo->prepare("update usuario set fotoPerfil = :imagem where id = :id");
            $stmt->bindValue(':id', $us->getId());
            $stmt->bindValue(':imagem', '../Img/' . $nome_imagem . $extensao);

            //Verificar se os dados foram inseridos com sucesso
            if ($stmt->execute()) {

                $us->setFotoPerfil('../Img/' . $nome_imagem . $extensao);
                $_SESSION['usuario'] = serialize($us);
                //Recuperar último ID inserido no banco de dados
                //$ultimo_id = $pdo->lastInsertId();
                $ultimo_id = $us->getId();

                //DiretÃ³rio onde o arquivo vai ser salvo
                $diretorio = '../Img/' . md5($ultimo_id) . $extensao;


                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio)) {
                    header('Location: ../Tela/home.php');
                } else {
                    header('Location: ../Tela/home.php?msg=erro');
                }
            } else {
                header('Location: ../Tela/alterarCurso.php?msg=erro');
            }
        } else {
            header('Location: ../Tela/alterarEnderecoUsuario.php?msg=erro');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../index.php');
    }

    public function tornarUsuarioNormal() {
        $id = $_GET['id'];
        $usuario = new usuario();
        $usuario = unserialize($_SESSION['usuario']);
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("UPDATE usuario SET administrador = 'false' where id = :id ;");
        $sql->bindValue(':id', $id);
        if ($sql->execute()) {
            if ($usuario->getId() == $id) {
                $_SESSION['usuario'] = serialize($this->selectUsuarioPorId($id));
            }
            header("Location: ../Tela/verMais.php?id=" . $id);
        } else {
            header("Location: ../Tela/listarUsuario.php?msg=erro");
        }
    }

    public function tornarUsuarioAdministrador() {
        $id = $_GET['id'];
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("UPDATE usuario SET administrador = 'true' where id = :id;");
        $sql->bindValue(':id', $id);
        if ($sql->execute()) {
            //return $sql;
            header("Location: ../Tela/verMais.php?id=" . $id);
        } else {
            header("Location: ../Tela/listarUsuario.php?msg=erro");
        }
    }

    public function verificarAdministrador($id) {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("SELECT administrador FROM usuario where id = :id AND administrador = 'true';");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
