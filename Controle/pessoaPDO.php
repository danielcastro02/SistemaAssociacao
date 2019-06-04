<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath("./index.php")) {
    include_once "./Controle/conexao.php";
    include_once './Modelo/pessoa.php';
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/conexao.php";
    include_once '../Modelo/pessoa.php';
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/conexao.php";
            include_once '../../Modelo/pessoa.php';
        }
    }
}

class pessoaPDO{
    public function inserirPessoa(pessoa $pessoa){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("insert into pessoa values (default , :nome, :cpf_cnpj , :cep , :cidade , :bairro , :rua , :numero , :telefone , :email);");
        $stmt->bindValue(':nome', $pessoa->getNome());
        $stmt->bindValue(':cpf_cnpj', $pessoa->getCpfCnpj());
        $stmt->bindValue(':cep', $pessoa->getCep());
        $stmt->bindValue(':cidade', $pessoa->getCidade());
        $stmt->bindValue(':bairro', $pessoa->getBairro());
        $stmt->bindValue(':rua', $pessoa->getRua());
        $stmt->bindValue(':numero', $pessoa->getNumero());
        $stmt->bindValue(':email', $pessoa->getEmail());
        $stmt->bindValue(':telefone', $pessoa->getTelefone());
        if($stmt->execute()){
            $stmt = $pdo->prepare('select * from pessoa where cpf_cnpj = :cpf;');
            $stmt->bindValue(':cpf', $pessoa->getCpfCnpj());
            $stmt->execute();
            return new pessoa($stmt->fetch());
        }else{
            return false;
        }
        
    }
    
    public function updatePessoa(pessoa $pessoa){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("update pessoa set nome = :nome, cpf_cnpj = :cpf_cnpj ,cep = :cep ,cidade = :cidade ,bairro = :bairro ,"
                . "rua = :rua ,numero = :numero ,telefone = :telefone ,email = :email where id_pessoa = :id;");
        $stmt->bindValue(':nome', $pessoa->getNome());
        $stmt->bindValue('cpf_cnpj', $pessoa->getCpfCnpj());
        $stmt->bindValue(':cep', $pessoa->getCep());
        $stmt->bindValue(':cidade', $pessoa->getCidade());
        $stmt->bindValue('bairro', $pessoa->getBairro());
        $stmt->bindValue(':rua', $pessoa->getRua());
        $stmt->bindValue(':numero', $pessoa->getNumero());
        $stmt->bindValue(':email', $pessoa->getEmail());
        $stmt->bindValue(':telefone', $pessoa->getTelefone());
        $stmt->bindValue(':id', $pessoa->getIdPessoa());
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}