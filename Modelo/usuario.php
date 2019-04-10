<?php

class usuario {

    private $id;
    private $nome;
    private $usuario;
    private $cidade;
    private $bairo;
    private $rua;
    private $numero;
    private $cep;
    private $cpf;
    private $rg;
    private $data_nasc;
    private $telefone;
    private $email;
    private $pode_logar;
    private $administrador;
    private $senha1;
    private $senha2;
    private $idade;

    public function __construct() {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
        if (isset($this->data_nasc)) {
            $anoAtual = date('Y');
            $mesAtual = date('m');
            $diaAtual = date('d');
            $nascimento = $data_nasc;
            list($ano, $mes, $dia) = explode('-', $this->data_nasc);
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

    function getBairo() {
        return $this->bairo;
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

    function setBairo($bairo) {
        $this->bairo = $bairo;
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
            $anoAtual = date('Y');
            $mesAtual = date('m');
            $diaAtual = date('d');
            $nascimento = $data_nasc;
            list($ano, $mes, $dia) = explode('-', $this->data_nasc);
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
