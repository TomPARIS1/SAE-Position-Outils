<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/outil.php';
    
    $database = new Database();
    $db = $database->getConnection();

    $item = new Outil($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getOutilsFromId();
    
    if($item->type != null){
        
        if (isset($_GET['type']))
        {
            $item->type = $_GET['type'];
        }
    
        if (isset($_GET['id_etagere']))
        {
            $item->id_etagere = $_GET['id_etagere'];
        }
    
        if (isset($_GET['nbr_utilisations']))
        {
            $item->nbr_utilisations = $_GET['nbr_utilisations'];
        }
    
        if (isset($_GET['x']))
        {
            
            $item->x = $_GET['x'];
        }

        if (isset($_GET['y']))
        {
            
            $item->y = $_GET['y'];
        }
      
        $result = $item->updateOutil(); 

        $emp_arr = array(
            "id" =>  $item->id,
            "id_etagere" => $item->id_etagere,
            "nbr_utilisations" => $item->nbr_utilisations,
            "type" => $item->type,
            "x" => $item->x,
            "y" => $item->y,
            "result" => $result
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Recipe not found.");
    }
?>
