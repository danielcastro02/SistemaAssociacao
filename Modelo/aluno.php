<?php
if (realpath("./index.php")) {
    include_once './Modelo/usuario.php';
} else {
    if (realpath("../index.php")) {
        include_once '../Modelo/usuario.php';
    } else {
        if (realpath("../../index.php")) {
            include_once '../../Modelo/usuario.php';
        }
    }
}
class aluno extends usuario {

    private $id_responsavel;
    private $id_curso_ref;
    private $id_caixa_ref;
    private $saldo;
    private $data_inicio;
    private $previsao_conclusao;
    private $concluido;
    
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
    
    function getData_inicio() {
        return $this->data_inicio;
    }

    function getConcluido() {
        return $this->concluido;
    }

    function setData_inicio($data_inicio) {
        $this->data_inicio = $data_inicio;
    }

    function setConcluido($concluido) {
        $this->concluido = $concluido;
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

    function setId_responsavel($id_responsavel) {
        $this->id_responsavel = $id_responsavel;
    }
    
    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    function setPrevisao_conclusao($previsao_conclusao) {
        $this->previsao_conclusao = $previsao_conclusao;
    }
    
    function getId_cursoRef() {
        return $this->id_curso_ref;
    }

    function setId_cursoRef($id_curso_ref) {
        $this->id_curso_ref = $id_curso_ref;
    }

    public function getIdCaixaRef()
    {
        return $this->id_caixa_ref;
    }

    public function setIdCaixaRef($id_caixa_ref)
    {
        $this->id_caixa_ref = $id_caixa_ref;
    }

    

}
