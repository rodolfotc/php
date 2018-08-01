<?php

require_once("Banco.php");

class PessoaFisicaDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }


}

?>