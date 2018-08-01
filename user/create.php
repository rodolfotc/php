<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);



$jsonPost = $_POST["json"];


$obj = json_decode($jsonPost);


// set user property values

    $user->nome = $obj->nome;
    $user->email = $obj->email;
    $user->status = "B";
    $user->password = md5($obj->password);
 

// create the user, save mysql
$user->create(); 




?>