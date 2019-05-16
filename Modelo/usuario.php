<?php

if (realpath("./index.php")) {
    include_once './Modelo/pessoa.php';
} else {
    if (realpath("../index.php")) {
        include_once '../Modelo/pessoa.php';
    } else {
        if (realpath("../../index.php")) {
            include_once '../../Modelo/pessoa.php';
        }
    }
}

class usuario extends pessoa {

    protected $id_pessoa;
    protected $usuario;
    protected $rg;
    protected $data_nasc;
    protected $data_associacao;
    protected $fotoPerfil;
    protected $pode_logar;
    protected $administrador;
    protected $senha1;
    protected $senha2;
    

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

            list($ano, $mes, $dia) = explode('-', $nascimento);

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

    function getIdPessoa() {
        return $this->id_pessoa;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getRg() {
        return $this->rg;
    }

    function getData_nasc() {
        return $this->data_nasc;
    }
    
    function getData_nascFormatada() {
        $vet = explode($this->data_nasc , "-");
        return $vet[3].'/'.$vet[2].'/'.$vet[1];
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

    function setIdPessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setData_nasc($data_nasc) {
        $this->data_nasc = $data_nasc;
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

    function getIdade() {
        if (isset($this->data_nasc)) {
            date_default_timezone_set('America/Sao_Paulo');
            $anoAtual = date('Y');
            $mesAtual = date('m');
            $diaAtual = date('d');
            $nascimento = $data_nasc;
            list($ano, $mes, $dia) = explode('-', $this->data_nasc);
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
    }

}
