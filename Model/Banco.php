<?php

class BancoFinanceiro{
    private $id;
    private $codigo;
    private $nome;
    
    function getId() {
        return $this->id;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }




}
