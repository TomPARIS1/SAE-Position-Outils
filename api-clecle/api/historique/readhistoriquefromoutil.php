<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/historique.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Outil($db);

    $etagere_id = isset($_GET['id_etagere']) ? $_GET['id_etagere'] : die();

    $stmt = $items->getReservationFromOutil($etagere_id);
    $itemCount = $stmt->rowCount();
    
    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_historique" => $id_historique,
                "id_outil" => $id_outil,
                "x" => $x,
                "y" => $y,
                "date" => $date
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