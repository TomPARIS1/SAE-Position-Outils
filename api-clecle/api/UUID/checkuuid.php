<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/uui_key.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $item = new UUI_key($db);
    
    $data = json_decode(file_get_contents("php://input"));


    $item->UUID = $data->UUID;
    echo $item->checkUUID();

    /*
    $item->id_outil = $data->id_outil;
    $item->date_fin = $date_fin;
    $item->date_debut = $data->date_debut;
    

    if($item->createReservation()){
        echo "L'outil a été reservé de" . $item->date_debut . " a " . $item->date_fin;
    } else{
        echo "L'outil n'a pas pu être reservé";
    }
    */
?>