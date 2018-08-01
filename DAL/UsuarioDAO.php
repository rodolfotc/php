<?php
require_once("PessoaFisicaDAO.php");
require_once("Banco.php");

class UsuarioDAO {

    private $pdo;
    private $debug;
    private $filterOff;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
        $this->filterOff = false;
    }



    public function RetornaCod(int $id) {
        try {
            $sql = "select u.*, p.id as idPf, p.nome, p.email, p.cpf, p.sexo, p.nascimento, p.cliente_id  from usuario u inner join pessoaFisica p on u.id = p.usuario_id WHERE u.id = :id order by u.id asc";
            $param = array(
                ":id" => $id
            );

            $resultado = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($resultado != null) {
                $usuario = new Usuario();
                $pessoaFisica = new PessoaFisica();
                $pessoaFisica->setId($resultado["idPf"]);
                $pessoaFisica->setNome($resultado["nome"]);
                $pessoaFisica->setEmail($resultado["email"]);
                $pessoaFisica->setSexo($resultado["sexo"]); 
                $pessoaFisica->setNascimento($resultado["nascimento"]);
                $pessoaFisica->setCpf($resultado["cpf"]);
                
                $usuario->setLogin($resultado["login"]);
                $usuario->setStatus($resultado["status"]);
                $usuario->setPermissao($resultado["permissao"]);
                $usuario->setPassword($resultado["password"]);
                $usuario->setId($resultado["id"]);
                
                $Usuario[] = $usuario;
                $PessoaFisica[] = $pessoaFisica;
                $lista[0] = $Usuario;
                $lista[1] = $PessoaFisica;


                //return $usuario;
                return $lista;
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function AutenticarUsuario(string $login, string $password, int $permissao) {
        try {

            //new login
            if ($permissao == 1) {
                $sql = "SELECT id, nome,status FROM usuario WHERE nome = :nome AND password = :password";

                //array associativo, parametro e nome obrigatoriamente igual
                $param = array(
                    ":nome" => $login,
                    ":password" => $password
                );
            } else {
                $sql = "SELECT id, nome, status FROM usuario WHERE nome = :nome AND password = :password";

                $param = array(
                    ":nome" => $login,
                    ":password" => $password
                );
            }

         
            
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null) {
                $usuario = new Usuario();
                $usuario->setId($dt["id"]);
                $usuario->setLogin($dt["nome"]);
                $usuario->setStatus($dt["status"]);

                
                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }



}

?>