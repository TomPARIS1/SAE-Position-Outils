<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/compte.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Compte($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->nom = $data->nom;
    $item->mdp = $data->mdp;
    $item->niveau = $data->niveau;
    
    if($item->createCompte()){
        echo 'Le compte a été créé';
    } else{
        echo "Le compte n'a été pas créé";
    }
?>