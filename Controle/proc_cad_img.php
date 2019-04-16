<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Tela/login.php');
}
include_once '../Modelo/usuario.php';
$us = new usuario();
$us = unserialize($_SESSION['usuario']);
include_once './conexao.php';

$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $nome_imagem = md5($us->getId());
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $ext = explode('.', $_FILES['imagem']['tmp_name']);
    $extensao = ".".$ext[1];
    $conexao = new conexao();
    $pdo = $conexao->getConexao();
    $stmt = $pdo->prepare("INSERT INTO foto_perfil VALUES(:id_usuario, :imagem)");
    $stmt->bindValue(':id_usuario', $us->getId());
    $stmt->bindValue(':imagem', $nome_imagem.$extensao);
    
    //Verificar se os dados foram inseridos com sucesso
    if ($stmt->execute()) {
        //Recuperar último ID inserido no banco de dados
        //$ultimo_id = $pdo->lastInsertId();
        $ultimo_id = $us->getId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../Img/' . md5($ultimo_id) . $extensao;

        //Criar a pasta de foto
        //mkdir($diretorio, 0755);

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nome_imagem)) {
            //header('Location: ../Tela/alterarDadosUsuario.php');
        } else {
            //header('Location: ../Tela/loginRecusado.php');
        }
    } else {
        //header('Location: ../Tela/alterarCurso.php');
    }
} else {
    //header('Location: ../Tela/alterarEnderecoUsuario.php');
}