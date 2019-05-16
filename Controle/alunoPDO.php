<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/conexao.php";
    include_once './Modelo/aluno.php';
    include_once './Modelo/usuario.php';
    include_once "./Controle/usuarioPDO.php";
    include_once "./Controle/cursoPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/conexao.php";
        include_once '../Modelo/aluno.php';
        include_once '../Modelo/usuario.php';
        include_once "../Controle/usuarioPDO.php";
        include_once "../Controle/cursoPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/conexao.php";
            include_once '../../Modelo/aluno.php';
            include_once '../../Modelo/usuario.php';
            include_once "../../Controle/usuarioPDO.php";
            include_once "../../Controle/cursoPDO.php";
        }
    }
}

class alunoPDO {

    public function inserirAluno() {
        $al = new aluno($_POST);
        $usuarioPDO = new usuarioPDO();
        $resultado = $usuarioPDO->inserirUsuario(new usuario($_POST));
        try{
            $al->atualizar($resultado);
            $conexao = new conexao();
            $pdo = $conexao->getConexao();
            $us->setIdPessoa($this->buscarIDporRG($us->getRg()));
            $sql = $pdo->prepare("insert into aluno values(:id,null,:curso,0, :dataInicio ,:conclusao, 'false');");
            $sql->bindValue(':id', $us->getIdPessoa());
            $sql->bindValue(':curso', $al->getId_cursoRef());
            $sql->bindValue(':dataInicio', $al->getData_inicio());
            $sql->bindValue(':conclusao', $al->getPrevisao_conclusao());
            if ($sql->execute()) {
                header("Location: ../Tela/Cadastro/orientacao.php?msg=" . $this->enviarOrientacaoCadAluno($resultado));
            } else {
                header("Location: ../Tela/Cadastro/cadastroAluno.php?msg=erroInserirAluno");
            }
        } catch (Exception $e) {
            header('location: ../Tela/Cadastro/cadastroAluno.php?msg=' . $resultado);
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
            $_SESSION['temp'] = $us->getIdPessoa();
            return "cadastrarResponsavel";
        }
    }
    
    public function updateAluno() {
        $usuarioPDO = new usuarioPDO();
        $conexao = new conexao();
        $pdo = $conexao->getConexao();
        $aluno = new aluno();
        $aluno = unserialize($_SESSION['aluno']);
        $aluno->atualizar($usuarioPDO->getLogado());
        $aluno->atualizar($_POST);
        $senhaantiga = md5($aluno->getSenha1());
        $stmt = $pdo->prepare('SELECT senha FROM usuario WHERE id = :id');
        $stmt->bindValue(':id', $aluno->getIdPessoa());
        $stmt->execute();
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($aluno->getSenha1() == "") {
            header('Location: ../Tela/Update/alterarAluno.php?msg=senhavazia');
        } else {
            if ($linha['senha'] == $senhaantiga) {
                $stmt = $pdo->prepare('UPDATE aluno SET id_curso = :curso, data_inicio = :dataInicio , previsao_conclusao = :previsao_conclusao, concluido = :concluido WHERE id_pessoa = :id;');
                $stmt->bindValue(':curso', $aluno->getId_curso());
                $stmt->bindValue(':previsao_conclusao', $aluno->getPrevisao_conclusao());
                $stmt->bindValue(':dataInicio', $aluno->getData_inicio());
                $stmt->bindValue(':concluido', $aluno->getConcluido());
                $stmt->bindValue(':id', $aluno->getId_pessoa());
                if ($stmt->execute()) {
                    $_SESSION['aluno'] = serialize($aluno);
                    header('Location: ../Tela/Update/alterarAluno.php?msg=sucesso');
                } else {
                    header('Location: ./Tela/Update/alterarAluno.php?msg=bderro');
                }
            } else {
                header('Location: ../Tela/Update/alterarAluno.php?msg=senhaerrada');
            }
        }
    }

}
