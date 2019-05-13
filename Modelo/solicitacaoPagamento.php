<?php

class solicitacaoPagamento {

    private $id_solicitacao_pagamento;
    private $id_usuario_ref;
    private $id_cobranca_ref;
    private $comprovante;
    private $aprovada;
    private $pendente;
    
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
    
    function getId_solicitacao_pagamento() {
        return $this->id_solicitacao_pagamento;
    }

    function getId_usuario_ref() {
        return $this->id_usuario_ref;
    }

    function getId_cobranca_ref() {
        return $this->id_cobranca_ref;
    }

    function getComprovante() {
        return $this->comprovante;
    }

    function getAprovada() {
        return $this->aprovada;
    }

    function getPendente() {
        return $this->pendente;
    }

    function setId_solicitacao_pagamento($id_solicitacao_pagamento) {
        $this->id_solicitacao_pagamento = $id_solicitacao_pagamento;
    }

    function setId_usuario_ref($id_usuario_ref) {
        $this->id_usuario_ref = $id_usuario_ref;
    }

    function setId_cobranca_ref($id_cobranca_ref) {
        $this->id_cobranca_ref = $id_cobranca_ref;
    }

    function setComprovante($comprovante) {
        $this->comprovante = $comprovante;
    }

    function setAprovada($aprovada) {
        $this->aprovada = $aprovada;
    }

    function setPendente($pendente) {
        $this->pendente = $pendente;
    }


    
}
