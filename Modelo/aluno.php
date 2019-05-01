<?php

class aluno {

    private $id_usuario;
    private $id_responsavel;
    private $id_curso;
    private $saldo;
    private $previsao_conclusao;
    
    public function __construct() {
        if (func_num_args() != 0) {
            $atributos = func_get_args()[0];
            foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
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
    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getId_responsavel() {
        return $this->id_responsavel;
    }

    function getSaldo() {
        return $this->saldo;
    }

    function getPrevisao_conclusao() {
        return $this->previsao_conclusao;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setId_responsavel($id_responsavel) {
        $this->id_responsavel = $id_resposnavel;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    function setPrevisao_conclusao($previsao_conclusao) {
        $this->previsao_conclusao = $previsao_conclusao;
    }
    
    function getId_curso() {
        return $this->id_curso;
    }

    function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }



}
