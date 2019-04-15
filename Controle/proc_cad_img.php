<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Tela/login.php');
}
include_once '../Modelo/usuario.php';
$user = new usuario();
$us = unserialize($_SESSION['usuario']);
include_once './conexao.php';

$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $nome_imagem = $_FILES['imagem']['name'];
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $conexao = new conexao();
    $pdo = $conexao->getConexao();
    $stmt = $pdo->prepare("INSERT INTO imagens (id, id_usuario, nome, imagem) VALUES(default, :id_usuario, :nome, :imagem)");
    $stmt->bindValue(':id_usuario', $us->getId());
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':imagem', $nome_imagem);

    //Verificar se os dados foram inseridos com sucesso
    if ($stmt->execute()) {
        //Recuperar último ID inserido no banco de dados
        //$ultimo_id = $pdo->lastInsertId();
        $ultimo_id = 1;

        //Diretório onde o arquivo vai ser salvo
        $diretorio = 'Img/' . $ultimo_id . '/';

        //Criar a pasta de foto
        mkdir($diretorio, 0755);

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nome_imagem)) {
            $_SESSION['msg'] = "<p style='color:green'>Dados salvos com sucesso e upload da imagem realizado com sucesso.</p>";
            header('Location: ../Tela/alterarDadosUsuario.php');
        } else {
            $_SESSION['msg'] = "<p><span style='color:green'>Dados salvos com sucesso. </span><span style='color:red;'>Erro ao realizar o upload da imagem.</span></p>";
            header('Location: ../Tela/loginRecusado.php');
        }
    } else {
        $_SESSION['msg'] = "<p style='color:red'>Erro ao salvar os dados</p>";
        header('Location: ../Tela/alterarCurso.php');
    }
} else {
    $_SESSION['msg'] = "<p style='color:red'>Erro ao salvar os dados</p>";
    header('Location: ../Tela/alterarEnderecoUsuario.php');
}