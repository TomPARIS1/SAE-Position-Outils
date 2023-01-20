<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/uui_key.php';
    include_once '../../class/compte.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $item = new UUI_key($db);
    $itemc = new Compte($db);
    
    $data = json_decode(file_get_contents("php://input"));

    $item->UUID = $data->UUID;
    $itemc = $item->checkUUID();

    if($itemc->id != null){
        // create array
        $emp_arr = array(
            "result" => true
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else
    {
        $emp_arr = array(
            "result" => false
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    
?>