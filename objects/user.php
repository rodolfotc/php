<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuario";
 
    // object properties
    public $id;
    public $nome;
    public $email;
    public $status;
    public $password;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }



    function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nome=:nome, email=:email, status=:status, password=:password";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nome=htmlspecialchars(strip_tags($this->nome));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->password=htmlspecialchars(strip_tags($this->password));
 
    // bind values
    $stmt->bindParam(":nome", $this->nome);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":password", $this->password);
    
 
    // execute query
    
    if($stmt->Execute()){
        return true;
    } else {
        return false;
    }

     
    }


    // used when filling up the update product form
function readOne(){
 
    // query to read single record
    $query = "SELECT
               id, nome, email, status, password
            FROM
                " . $this->table_name . " 
            WHERE
                id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->id = $row['id'];
    $this->nome = $row['nome'];
    $this->email = $row['email'];
    $this->status = $row['status'];
    $this->password = $row['password'];

  
}

function searchEmail(){
 
    // query to read single record
    $query = "SELECT
               id, email
            FROM
                " . $this->table_name . " 
            WHERE
                email = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->email);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->id = $row['id'];
    $this->email = $row['email'];

  
}

function searchNome(){
 
    // query to read single record
    $query = "SELECT
               id, nome
            FROM
                " . $this->table_name . " 
            WHERE
                nome = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->nome);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->id = $row['id'];
    $this->nome = $row['nome'];

  
}



}