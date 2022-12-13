<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/reservation.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Reservation($db);
    $item->id = isset($_GET['id_reservation']) ? $_GET['id_reservation'] : die();
    $item->getReservationFromId();
    
    if($item->type != null){
        $result = $item->deleteReservationFromId(); 

        $emp_arr = array(
            "id_reservation" => $item->id_reservation,
            "id_outil" => $item->id_outil,
            "date_fin" => $item->date_fin,
            "date_debut" => $item->date_debut
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Recipe not found.");
    }
?>
