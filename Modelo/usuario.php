<?php

class usuario {

    private $id;
    private $nome;
    private $usuario;
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;
    private $cep;
    private $cpf;
    private $rg;
    private $data_nasc;
    private $telefone;
    private $email;
    private $data_associacao;
    private $fotoPerfil;
    private $pode_logar;
    private $administrador;
    private $senha1;
    private $senha2;
    private $idade;
    

    public function __construct() {
        if (func_num_args() == 1) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
        if (!is_null($this->data_nasc) && $this->data_nasc!= '') {
            date_default_timezone_set('America/Sao_Paulo');
            $anoAtual = date('Y');
            $mesAtual = date('m');
            $diaAtual = date('d');
            $nascimento = $this->data_nasc;

            list($dia, $mes, $ano) = explode('/', $nascimento);

            $idade = $anoAtual - $ano;
            if ($mesAtual > $mes) {
                $this->idade = $idade;
            } else {
                if ($mesAtual == $mes and $diaAtual >= $dia) {
                    $this->idade = $idade;
                } else {
                    $idade--;
                    $this->idade = $idade;
                }
            }
        }
    }

    function atualizar($vetor) {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
        $this->setIdade();
    }
    
    function getData_associacao() {
        return $this->data_associacao;
    }

    function setData_associacao($data_associacao) {
        $this->data_associacao = $data_associacao;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getCep() {
        return $this->cep;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getRg() {
        return $this->rg;
    }

    function getData_nasc() {
        return $this->data_nasc;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }
    
    function getFotoPerfil() {
        return $this->fotoPerfil;
    }

    function setFotoPerfil($fotoPerfil) {
        $this->fotoPerfil = $fotoPerfil;
    }
    
    function getPode_logar() {
        return $this->pode_logar;
    }

    function getAdministrador() {
        return $this->administrador;
    }

    function getSenha1() {
        return $this->senha1;
    }

    function getSenha2() {
        return $this->senha2;
    }

    function getIdade() {
        return $this->idade;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setData_nasc($data_nasc) {
        $this->data_nasc = $data_nasc;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPode_logar($pode_logar) {
        $this->pode_logar = $pode_logar;
    }

    function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }

    function setSenha1($senha1) {
        $this->senha1 = $senha1;
    }

    function setSenha2($senha2) {
        $this->senha2 = $senha2;
    }

    function setIdade() {
        if (isset($this->data_nasc)) {
            date_default_timezone_set('America/Sao_Paulo');
            $anoAtual = date('Y');
            $mesAtual = date('m');
            $diaAtual = date('d');
            $nascimento = $data_nasc;
            list($dia, $mes, $ano) = explode('/', $this->data_nasc);
            $idade = $anoAtual - $ano;
            if ($mesAtual > $mes) {
                $this->idade = $idade;
            } else {
                if ($mesAtual == $mes and $diaAtual >= $dia) {
                    $this->idade = $idade;
                } else {
                    $idade--;
                    $this->idade = $idade;
                }
            }
        }
    }

}
