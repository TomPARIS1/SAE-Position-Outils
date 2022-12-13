<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/reservation.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Reservation($db);

    $etagere_id = isset($_GET['id_outil']) ? $_GET['id_outil'] : die();

    $stmt = $items->getReservationFromOutil($id_outil);
    $itemCount = $stmt->rowCount();
    
    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_reservation" => $id_reservation,
                "id_outil" => $id_outil,
                "date_fin" => $date_fin,
                "date_debut" => $date_debut
            );

            array_push($employeeArr["body"], $e);
        }
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
    
?>