<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once './Modelo/pessoa.php';
    include_once "./Controle/conexao.php";
    include_once './Modelo/usuario.php';
//    include_once './Modelo/aluno.php';
//    include_once './Modelo/diretoria.php';
//    include_once './Controle/cursoPDO.php';
    include_once './Controle/pessoaPDO.php';
//    include_once './Modelo/curso.php';
} else {
    if (realpath("../index.php")) {
        include_once '../Modelo/pessoa.php';
        include_once "../Controle/conexao.php";
        include_once '../Modelo/usuario.php';
//        include_once '../Modelo/aluno.php';
//        include_once '../Modelo/diretoria.php';
//        include_once '../Controle/cursoPDO.php';
        include_once '../Controle/pessoaPDO.php';
//        include_once '../Modelo/curso.php';
    } else {
        if (realpath("../../index.php")) {
            include_once '../../Modelo/pessoa.php';
            include_once "../../Controle/conexao.php";
            include_once '../../Modelo/usuario.php';
//            include_once '../../Modelo/aluno.php';
//            include_once '../../Modelo/diretoria.php';
//            include_once '../../Controle/cursoPDO.php';
            include_once '../../Controle/pessoaPDO.php';
//            include_once '../../Modelo/curso.php';
        }
    }
}

class usuarioPDO {

    public function pesquisarUsuariosPorNome($pesquisa) {
        $pesquisa = '%' . $pesquisa . '%';
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        if ($pesquisa != null) {

            $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.nome like :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.cpf_cnpj like :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where u.rg like :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.cpf_cnpj = :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where u.rg = :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where u.pode_logar = 'false' and p.nome like :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where u.administrador = 'true' and p.nome like :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where u.pode_logar = 'true' and p.nome like :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where u.usuario like :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.email like :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where u.usuario = :pesquisa;");
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
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.email = :pesquisa;");
        $sql->bindValue(":pesquisa", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function selectTodosUsers($pesquisa) {
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $pesquisa = "%" . $pesquisa . "%";
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.nome like :nome or "
                . "u.usuario like :usuario or "
                . "cpf_cnpj like :cpf or u.rg like :rg or p.email like :email;");
        $sql->bindValue(":nome", $pesquisa);
        $sql->bindValue(":usuario", $pesquisa);
        $sql->bindValue(":cpf", $pesquisa);
        $sql->bindValue(":rg", $pesquisa);
        $sql->bindValue(":email", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            //echo 'false';
            return false;
        }
    }

    public function selectMembrosAtivos($pesquisa) {
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $pesquisa = "%" . $pesquisa . "%";
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where (p.nome like :nome or "
                . "u.usuario like :usuario or "
                . "p.cpf_conpj like :cpf or u.rg like :rg or p.email like :email) and u.pode_logar = 'true';");
        $sql->bindValue(":nome", $pesquisa);
        $sql->bindValue(":usuario", $pesquisa);
        $sql->bindValue(":cpf", $pesquisa);
        $sql->bindValue(":rg", $pesquisa);
        $sql->bindValue(":email", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {

            //echo 'false';
            return false;
        }
    }

    public function selectMembrosInativos($pesquisa) {
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $pesquisa = "%" . $pesquisa . "%";
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where (p.nome like :nome or "
                . "u.usuario like :usuario or "
                . "p.cpf_conpj like :cpf or u.rg like :rg or p.email like :email) and u.pode_logar = 'false';");
        $sql->bindValue(":nome", $pesquisa);
        $sql->bindValue(":usuario", $pesquisa);
        $sql->bindValue(":cpf", $pesquisa);
        $sql->bindValue(":rg", $pesquisa);
        $sql->bindValue(":email", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            //echo 'false';
            return false;
        }
    }

    public function selectMembrosDiretoria($pesquisa) {
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $pesquisa = "%" . $pesquisa . "%";
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where (p.nome like :nome or "
                . "u.usuario like :usuario or "
                . "p.cpf_conpj like :cpf or u.rg like :rg or p.email like :email) and "
                . "p.id_pessoa in (select id_pessoa from diretoria);");
        $sql->bindValue(":nome", $pesquisa);
        $sql->bindValue(":usuario", $pesquisa);
        $sql->bindValue(":cpf", $pesquisa);
        $sql->bindValue(":rg", $pesquisa);
        $sql->bindValue(":email", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            //echo 'false';
            return false;
        }
    }

    public function selectAdmin($pesquisa) {
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $pesquisa = "%" . $pesquisa . "%";
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where (p.nome like :nome or "
                . "u.usuario like :usuario or "
                . "p.cpf_conpj like :cpf or u.rg like :rg or p.email like :email) and u.administrador = 'true';");
        $sql->bindValue(":nome", $pesquisa);
        $sql->bindValue(":usuario", $pesquisa);
        $sql->bindValue(":cpf", $pesquisa);
        $sql->bindValue(":rg", $pesquisa);
        $sql->bindValue(":email", $pesquisa);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo 'false';
            return false;
        }
    }

    public function selectPorCurso($id) {
        $conexao = new conexao();
        $PDO = $conexao->getConexao();
        $sql = $PDO->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.id_pessoa in (select id_pessoa from aluno where id_curso = :pesquisa);");
        $sql->bindValue(':pesquisa', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function validaCpf($cpf) {
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);
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
                $v1 = 0;
                $v2 = 0;
                $cpfArr = str_split($cpf);
                for ($i = 0; $i < 9; $i++) {
                    $v1 += ($i + 1) * $cpfArr[$i];
                }
                $v1 = $v1 % 11;
                $v1 = $v1 % 10;
                for ($i = 1; $i < 9; $i++) {
                    $v2 += ($i) * $cpfArr[$i];
                }
                $v2 += 9 * $v1;
                $v2 = $v2 % 11;
                $v2 = $v2 % 10;

                if (($v1 != $cpfArr[9]) || ($v2 != $cpfArr[10])) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }

    private function verificarExistencia(usuario $us) {
        if ($this->pesquisarPorRGExata($us->getRg())) {
            return true;
        }
        if ($this->pesquisarPorCPFExata($us->getCpfCnpj())) {
            return true;
        }
        if ($this->pesquisarPorEmailExata($us->getEmail())) {
            return true;
        }
        if ($this->pesquisarPorUsuarioExata($us->getUsuario())) {
            return true;
        }
        return false;
    }

    public function inserirUsuario(usuario $us) {
        $pessoaPDO = new pessoaPDO();
        $us->atualizar($pessoaPDO->inserirPessoa(new pessoa($us)));
        $validacao = $this->validarFormlario($us);
        if ($validacao == 'true') { //validar estáincompleto
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $senhaMD5 = md5($us->getSenha1());
            $sql = $pdo->prepare("INSERT INTO usuario values ( :id_pessoa , :usuario , :senha , "
                    . " :rg , :nascimento, :data_associacao , :fotoPerfil , "
                    . ":podeLogar , 'false' );");
            $sql->bindValue(':id_pessoa', $us->getIdPessoa());
            $sql->bindValue(':senha', $senhaMD5);
            $sql->bindValue(':rg', $us->getRg());
            $sql->bindValue(':nascimento', $us->getData_nasc());
            $sql->bindValue(':data_associacao', $us->getData_associacao());
            $sql->bindValue(':fotoPerfil', '../Img/Src/user_icon.png');
            $sql = $this->verificaPodeLogar($sql);
            if ($sql->execute()) { //Sucesso ao cadastrar USUÁRIO
                return $us;
            } else {
                return 'erroInsertUsuario';
            }
        } else {
            return $validacao;
        }
    }

    private function verificaPodeLogar(PDOStatement $sql) {
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

    public function inserirResponsavel() {
        $us = new usuario($_POST);
        $resposta = $this->inserirUsuario($us);
        if ($resposta == 'true') {
            if (isset($_SESSION['temp'])) {
                $con = new conexao();
                $pdo = $con->getConexao();
                $us->setIdPessoa($this->buscarIDporRG($us->getRg()));
                $stmt = $pdo->prepare("update aluno set id_responsavel = :idresponsavel where id_usuario = :iduser ; ");
                $stmt->bindValue(':idresponsavel', $us->getIdPessoa());
                $stmt->bindValue(':iduser', $_SESSION['temp']);
                $id = $_SESSION['temp'];
                unset($_SESSION['temp']);
                if ($stmt->execute()) {
                    header('location: ../Tela/Cadastro/orientacao.php?msg=' . $this->enviarOrientacaoCadAluno($this->selectUsuarioPorId($id)));
                } else {
                    header('location: ../Tela/Cadastro/cadastroResponsavel.php?msg=erroInsert');
                }
            } else {
                header('location: ../Tela/Cadastro/cadastroResponsavel.php?msg=sucesso');
            }
        } else {
            header('location: ../Tela/Cadastro/cadastroResponsavel.php?msg=' . $resposta);
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

    private function validarFormlario(usuario $us) {
        if ($us->getSenha1() != null and $us->getSenha2() != null) { //completar
            if ($us->getSenha1() == $us->getSenha2()) {
                if ($this->validaSenha($us)) {
                    if ($this->validaCpf($us->getCpfCnpj())) {
                        if (!$this->verificarExistencia($us)) {
                            return true;
                        } else {
                            return 'dadosJaExistem';
                        }
                    } else {
                        return 'cpfInvalidos';
                    }
                } else {
                    return 'senhaInvalida';
                }
            } else {
                return 'senhasNaoCoincidem';
            }
        } else {
            return 'senhaVazia';
        }
    }

    public function validaSenhaJs() {
        $us = new usuario($_POST);
        $this->validaSenha($us);
    }

    private function validaSenha(usuario $us) {
        if (strlen($us->getSenha1()) < 8) {
            echo 'false';
            return false;
        } else {
            $arrNome = str_split($us->getNome(), 4);
            for ($i = 0; $i < count($arrNome); $i++) {
                if (strpos($us->getSenha1(), "" . $arrNome[$i])) {
                    echo 'false';
                    return false;
                }
            }
            for ($i = 0; $i < 10; $i++) {
                if (strpos($us->getSenha1(), '' . $i)) {
                    echo 'true';
                    return true;
                }
            }
            echo 'false';
            return false;
        }
    }

    public function buscarIDporRG($rg) {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("select id_pessoa from usuario where rg = :rg;");
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
        $sql = $pdo->prepare("select id_pessoa from usuario where cpf = :cpf;");
        $sql->bindValue(':cpf', $us->getCpfCnpj());
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $linha = $sql->fetch(PDO::FETCH_ASSOC);
            $id = $linha['id_pessoa'];
            return $id;
        } else {
            header("Location: ../index.php?msg=erroBuscarPorCPF");
        }
    }

    public function verificaMaioridadeJs() {
        if ($this->defineIdade($_POST['data_nasc']) >= 18) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    private function defineIdade($data_nasc) {
        date_default_timezone_set('America/Sao_Paulo');
        $anoAtual = date('Y');
        $mesAtual = date('m');
        $diaAtual = date('d');
        $nascimento = $data_nasc;
        list($dia, $mes, $ano) = explode('/', $nascimento);
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
        $sql = $pdo->prepare("SELECT * FROM usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa;");
        $sql->execute();
        return $sql;
    }

    public function tornarUsuarioInativo() {
        $id = $_GET['id'];
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("UPDATE usuario SET pode_logar = 'false' where id_pessoa = :id ;");
        $sql->bindValue(':id', $id);
        if ($sql->execute()) {
            //return $sql;
            header("Location: ../Tela/Listagem/listarUsuario.php");
        } else {
            header("Location: ../Tela/Listagem/listarUsuario.php");
        }
    }

    public function tornarUsuarioAtivo() {
        $id = $_GET['id'];
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $sql = $pdo->prepare("UPDATE usuario SET pode_logar = 'true' where id_pessoa = :id ;");
        $sql->bindValue(':id', $id);
        if ($sql->execute()) {
            //return $sql;
            header("Location: ../Tela/Listagem/listarUsuario.php");
        } else {
            header("Location: ../Tela/Listagem/listarUsuario.php");
        }
    }

    public function selectPresidente() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $stmt = $pdo->prepare("SELECT id_pessoa FROM diretoria WHERE cargo LIKE 'Presidente';");
        $stmt->execute();
        $linha = $stmt->fetch();
        $stmt = $pdo->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.id_pessoa = " . $linha['id_pessoa']);
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

    public function updateDadosUsuario() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $logado = new usuario();
        $logado = $this->getLogado();
        if ($_POST['oldsenha'] == "") {
            header('Location: ../Tela/Update/alterarDadosUsuario.php?msg=senhavazia');
        }
        $senhaantiga = md5($_POST['oldsenha']);
        $stmt = $pdo->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $logado->getIdPessoa());
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($linha['senha'] == $senhaantiga) {
            $pessoaPDO = new pessoaPDO();
            $us = $logado;
            $us->atualizar($_POST);
            $pessoaPDO->updatePessoa(new pessoa($us));
            $stmt = $pdo->prepare('UPDATE usuario SET  usuario = :usuario, rg = :rg, data_associacao = :dataAssociacao, senha = :senha WHERE id = :id;');
            $stmt->bindValue(':usuario', $us->getUsuario());
            $stmt->bindValue(':rg', $us->getRg());
            $stmt->bindValue(':dataAssociacao', $us->getData_associacao());
            $stmt->bindValue(':id', $us->getIdPessoa());
            if (($us->getSenha2() == "") && ($us->getSenha1() == "")) {
                $stmt->bindValue(':senha', $senhaantiga);
            } else {
                if($this->validaSenha($us)){
                    $stmt->bindValue(':senha', md5($us->getSenha1()));
                }else{
                    header('location: ../Tela/Update/alterarDadosUsuario.php');
                }
            }
            if ($stmt->execute()) {
                $logado->atualizar($_POST);
                $_SESSION['usuario'] = serialize($logado);
                header('Location: ../Tela/Update/alterarDadosUsuario.php?msg=sucessoss');
            } else {
                header('Location: ../Tela/Update/alterarDadosUsuario.php?msg=bderross');
            }   
        }
    }


    public function updateEnderecoUsuario() {
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $logado = $this->getLogado();
        $logado->atualizar($_POST);
        $senhaantiga = md5($us->getSenha1());
        $stmt = $pdo->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $logado->getIdPessoa());
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($us->getSenha1() == "") {
            header('Location: ../Tela/Update/alterarEnderecoUsuario.php?msg=senhavazia');
        } else {
            if ($linha['senha'] == $senhaantiga) {
                $pessoaPDO = new pessoaPDO();
                if($pessoaPDO->updatePessoa(new pessoa($logado))){
                    $_SESSION['usuario'] = serialize($logado);
                    header('Location: ../Tela/Update/alterarEnderecoUsuario.php?msg=sucesso');
                } else {
                    header('Location: ./Tela/Update/alterarEnderecoUsuario.php?msg=bderro');
                }
            } else {
                header('Location: ../Tela/Update/alterarEnderecoUsuario.php?msg=senhaerrada');
            }
        }
    }

    public function login() {
        $conexao = new conexao();
        $senha = md5($_POST['senha']);
        $pdo = $conexao->getConexao();
        $stmt = $pdo->prepare('SELECT * FROM usuario as u inner join pessoa as p on p.id_pessoa = u.id_pessoa WHERE u.usuario LIKE :usuario AND u.senha LIKE :senha;');
        $stmt->bindValue(':usuario', $_POST['usuario']);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $us = new usuario($linha);
            if ($us->getPode_logar() == 'false') {
                header('Location: ../Tela/Sistema/loginrecusado.php');
            } else {
                $_SESSION['usuario'] = serialize($us);
                $stmt = $pdo->prepare('SELECT * FROM aluno WHERE id_usuario = :id;');
                $stmt->bindValue(':id', $us->getIdPessoa());
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $l = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($us->getIdade() < 18 && $l['id_responsavel'] == 'null') {
                        $rgtemp = $us->getRg();
                        session_destroy();
                        session_start();
                        $_SESSION['temp'] = $this->buscarIDporRG($rgtemp);
                        header('location: ../Tela/Cadastro/orientacao.php?msg=cadastrarResponsavel');
                    } else {
                        $al = new aluno($l);
                        $_SESSION['aluno'] = serialize($al);
                    }
                    $stmt = $pdo->prepare('SELECT cargo FROM diretoria WHERE id_usuario = :id;');
                    $stmt->bindValue(':id', $us->getIdPessoa());
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $s = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['diretoria'] = serialize(new diretoria($s));
                    }
                }
                header('Location: ../Tela/Sistema/home.php');
            }
        } else {
            header("Location: ../Tela/Sistema/login.php?msg=false");
        }
    }

    public function selectUsuarioPorId($id) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("select * from usuario as u inner join pessoa as p on  p.id_pessoa = u.id_pessoa where p.id_pessoa = :id;");
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
            $nome_imagem = md5($us->getIdPessoa());
            //Inserir no BD
            $ext = explode('.', $_FILES['imagem']['name']);
            $extensao = "." . $ext[1];
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $stmt = $pdo->prepare("update usuario set fotoPerfil = :imagem where id_pessoa = :id");
            $stmt->bindValue(':id', $us->getId());
            $stmt->bindValue(':imagem', '../Img/Perfil/' . $nome_imagem . $extensao);

            //Verificar se os dados foram inseridos com sucesso
            if ($stmt->execute()) {

                $us->setFotoPerfil('../Img/Perfil/' . $nome_imagem . $extensao);
                $_SESSION['usuario'] = serialize($us);
                //Recuperar último ID inserido no banco de dados
                //$ultimo_id = $pdo->lastInsertId();
                $ultimo_id = $us->getId();

                //DiretÃ³rio onde o arquivo vai ser salvo
                $diretorio = '../Img/Perfil/' . md5($ultimo_id) . $extensao;


                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio)) {
                    header('Location: ../Tela/Sistema/home.php');
                } else {
                    header('Location: ../Tela/Sistema/home.php?msg=erro');
                }
            } else {
                header('Location: ../Tela/Sistema/home.php?msg=erro');
            }
        } else {
            header('Location: ../Tela/Sistema/home.php?msg=erro');
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
            header("Location: ../Tela/Listagem/verMais.php?id=" . $id);
        } else {
            header("Location: ../Tela/Listagem/listarUsuario.php?msg=erro");
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
            header("Location: ../Tela/Listagem/verMais.php?id=" . $id);
        } else {
            header("Location: ../Tela/Listagem/listarUsuario.php?msg=erro");
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
