<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once "./conexao.php";

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
        $con = $conexao->getConexao();
        $stmt = $con->prepare('SELECT * FROM usuario WHERE usuario LIKE :usuario AND senha LIKE :senha;');
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
            if($stmt->execute()){
                $_SESSION['nome'] = $_POST['nome'];
                $_SESSION['usuario'] = $_POST['usuario'];
                $_SESSION['cpf'] = $_POST['cpf'];
                $_SESSION['rg'] = $_POST['rg'];
                $_SESSION['telefone'] = $_POST['telefone'];
                $_SESSION['email'] = $_POST['email'];
            }else{
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
    
    
    function logout(){
        session_destroy();
        header("location: ../index.php");
    }

}
?>
