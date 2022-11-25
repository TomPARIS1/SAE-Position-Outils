<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/outil.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Outil($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getOutilsFromId();
    
    if($item->type != null){
        // create array
        $emp_arr = array(
            "id" => $item->id,
            "id_etagere" => $item->id_etagere,
            "type" => $item->type,
            "nbr_utilisations" => $item->nbr_utilisations,
            "x" => $item->x,
            "y" => $item->y
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Aucun outil trouvé");
    }
?>