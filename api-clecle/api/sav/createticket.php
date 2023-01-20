<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/sav.php';
    include_once '../../class/uui_key.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $items = new SAV($db);
    $keyitem = new UUI_key($db);

    $data = json_decode(file_get_contents("php://input"));



    
    $items->nom = $data->nom;
    $items->issue = $data->issue;
    $items->commentaire = $data->commentaire;

    $keyitem->UUID = $data->uui_key;
    $id_from_uuid = $keyitem->IsValidUUID();
    $items->id_compte = $id_from_uuid;

    
    if ($id_from_uuid==null)
    {
        $emp_arr = array(
            "result" => false
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else
    {
        $created = $items->createSavTicket();

        $emp_arr = array(
            "result" => true,
            "created" => $created
        );

        http_response_code(200);
        echo json_encode($emp_arr);
    }
?>