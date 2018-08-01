<?php

if (file_exists("../DAL/UsuarioDAO.php")) {
    require_once("../DAL/UsuarioDAO.php");
} else {
    require_once("DAL/UsuarioDAO.php");
}

require_once("PessoaFisicaController.php");

class UsuarioController{

    private $usuarioDAO;
    private $banco;
    private $pessoafisica;
    private $retornoUsuario;
    private $retornoPessoaFisica;
    private $lastId;
    private $lastIdPessoaFisica;





    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
        $this->pessoafisica = new PessoaFisicaController();
        $this->banco = new Banco();
        $this->lastId = 0;
        $this->lastIdPessoaFisica = 0;
      
    }
    
    function getLastId() {
        return $this->lastId;
    }

    function getLastIdPessoaFisica() {
        return $this->lastIdPessoaFisica;
    }

    function setLastId($lastId) {
        $this->lastId = $lastId;
    }

    function setLastIdPessoaFisica($lastIdPessoaFisica) {
        $this->lastIdPessoaFisica = $lastIdPessoaFisica;
    }

    


    public function RetornaCod(int $usuarioId) {
        if ($usuarioId > 0) {
            return $this->usuarioDAO->RetornaCod($usuarioId);
        } else {
            return null;
        }
    }

    public function AutenticarUsuario(string $usu, string $senha, int $permissao) {

        if (strlen($usu) >= 3 && strlen($senha) >= 4 && $permissao == 1 ) {
            return $this->usuarioDAO->AutenticarUsuario($usu, md5($senha), $permissao);
        } else {
            return null;
        }
    }




}
