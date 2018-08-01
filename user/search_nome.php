<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
 

// set ID property of user 
$user->nome = isset($_GET['nome']) ? $_GET['nome'] : die();
 

// read the details of user 
$user->searchNome();
 
// create array
$user_arr = array(
    "id" =>  $user->id,
    "nome" => $user->nome
);


 
// make it json format
print_r(json_encode($user_arr));
?>