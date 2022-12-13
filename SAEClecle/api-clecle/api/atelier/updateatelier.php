<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/atelier.php';
    
    $database = new Database();
    $db = $database->getConnection();

    $item = new Atelier($db);
    $item->id = isset($_GET['id_atelier']) ? $_GET['id_atelier'] : die();
    $item->getEtagereFromId();
    
    if($item->x != null){
        
        if (isset($_GET['id_compte']))
        {
            $item->id_compte = $_GET['id_compte'];
        }
    
        if (isset($_GET['x']))
        {
            
            $item->x = $_GET['x'];
        }

        if (isset($_GET['y']))
        {
            
            $item->y = $_GET['y'];
        }

        if (isset($_GET['plan']))
        {
            
            $item->y = $_GET['plan'];
        }
      
        $result = $item->updateAtelier(); 

        $emp_arr = array(
            "id_compte" =>  $item->id_compte,
            "id_atelier" => $item->id_atelier,
            "x" => $item->x,
            "y" => $item->y,
            "plan" => $item->plan,
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