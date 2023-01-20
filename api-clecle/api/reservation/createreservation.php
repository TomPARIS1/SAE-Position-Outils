<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/reservation.php';
    include_once '../../class/uui_key.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $items = new Reservation($db);
    $keyitem = new UUI_key($db);

    $data = json_decode(file_get_contents("php://input"));



    $items->id_outil = $data->id_outil;
    $items->client_name = $data->nom_client;

    date_default_timezone_set('Europe/Paris');
    $items->date_debut = date('Y-m-d h:i:s', strtotime($data->date_deb));
    $items->date_fin = date('Y-m-d h:i:s', strtotime($data->date_fin));

    $keyitem->UUID = $data->uui_key;
    $id_from_uuid = $keyitem->IsValidUUID();

    
    if ($id_from_uuid==null || $items->getOwner()!=$id_from_uuid)
    {
        $emp_arr = array(
            "result" => false
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else
    {
        $created = $items->createReservation();

        $emp_arr = array(
            "result" => true,
            "created" => $created
        );

        http_response_code(200);
        echo json_encode($emp_arr);
    }
?>