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
    private $cargo;
    private $id_responsavel;
    private $curso;
    private $saldo;
    private $previsao_conclusao;
    private $idade;

    public function __construct() {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
            $anoAtual = date('Y');
            $mesAtual = date('m');
            $diaAtual = date('d');
            list($ano, $mes, $dia) = explode('-', $this->data_nasc);
            $idade = $anoAtual - $ano;
            if ($mesAtual > $mes) {
                $this->idade= $idade;
            } else {
                if ($mesAtual == $mes and $diaAtual >= $dia) {
                    $this->idade= $idade;
                } else {
                    $idade--;
                    $this->idade= $idade;
                }
            }
        }
    }
    function getIdade() {
        return $this->idade;
    }

    function setIdade($idade) {
        $this->idade = $idade;
        $anoAtual = date('Y');
            $mesAtual = date('m');
            $diaAtual = date('d');
            list($ano, $mes, $dia) = explode('-', $this->data_nasc);
            $idade = $anoAtual - $ano;
            if ($mesAtual > $mes) {
                $this->idade= $idade;
            } else {
                if ($mesAtual == $mes and $diaAtual >= $dia) {
                    $this->idade= $idade;
                } else {
                    $idade--;
                    $this->idade= $idade;
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

    function getCargo() {
        return $this->cargo;
    }

    function getId_responsavel() {
        return $this->id_responsavel;
    }

    function getCurso() {
        return $this->curso;
    }

    function getSaldo() {
        return $this->saldo;
    }

    function getPrevisao_conclusao() {
        return $this->previsao_conclusao;
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

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setId_responsavel($id_responsavel) {
        $this->id_responsavel = $id_responsavel;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    function setPrevisao_conclusao($previsao_conclusao) {
        $this->previsao_conclusao = $previsao_conclusao;
    }

}
