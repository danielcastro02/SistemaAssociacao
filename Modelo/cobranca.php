<?php

class cobranca {

    private $id_cobranca;
    private $id_usuario_ref;
    private $id_caixa_ref;
    private $valor;
    private $data_vencimento;
    private $pago;

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
    function getId_cobranca() {
        return $this->id_cobranca;
    }

    function getId_usuario_ref() {
        return $this->id_usuario_ref;
    }

    function getId_caixa_ref() {
        return $this->id_caixa_ref;
    }

    function getValor() {
        return $this->valor;
    }

    function getData_vencimento() {
        return $this->data_vencimento;
    }

    function getPago() {
        return $this->pago;
    }

    function setId_cobranca($id_cobranca) {
        $this->id_cobranca = $id_cobranca;
    }

    function setId_usuario_ref($id_usuario_ref) {
        $this->id_usuario_ref = $id_usuario_ref;
    }

    function setId_caixa_ref($id_caixa_ref) {
        $this->id_caixa_ref = $id_caixa_ref;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setData_vencimento($data_vencimento) {
        $this->data_vencimento = $data_vencimento;
    }

    function setPago($pago) {
        $this->pago = $pago;
    }


}
