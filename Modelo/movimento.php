<?php

class movimento {

    private $id_movimento;
    private $id_caixa_ref;
    private $id_curso;
    private $saldo;
    private $data_movimento;
    private $valor;
    private $saldo_movimento;

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
    
    function getId_movimento() {
        return $this->id_movimento;
    }

    function getId_caixa_ref() {
        return $this->id_caixa_ref;
    }

    function getId_curso() {
        return $this->id_curso;
    }

    function getSaldo() {
        return $this->saldo;
    }

    function getData_movimento() {
        return $this->data_movimento;
    }

    function getValor() {
        return $this->valor;
    }

    function getSaldo_movimento() {
        return $this->saldo_movimento;
    }

    function setId_movimento($id_movimento) {
        $this->id_movimento = $id_movimento;
    }

    function setId_caixa_ref($id_caixa_ref) {
        $this->id_caixa_ref = $id_caixa_ref;
    }

    function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    function setData_movimento($data_movimento) {
        $this->data_movimento = $data_movimento;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setSaldo_movimento($saldo_movimento) {
        $this->saldo_movimento = $saldo_movimento;
    }


}
