<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/reservation.php';
    include_once '../../class/uui_key.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $items = new Reservation($db);
    $keyitem = new UUI_key($db);

    $data = json_decode(file_get_contents("php://input"));

    $id_outil = $data->id_outil;
    $keyitem->UUID = $data->uui_key;
    $id_from_uuid = $keyitem->IsValidUUID();

    $items->id_outil = $id_outil;
    $stmt = $items->getReservationFromOutil();
    $itemCount = $stmt->rowCount();
    
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
        if($itemCount > 0){
            
            $employeeArr = array();
            $employeeArr["body"] = array();
            $employeeArr["itemCount"] = $itemCount;
            $employeeArr["result"] = true;
            $employeeArr["noreservation"] = false;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "id_reservation" => $id_reservation,
                    "id_outil" => $id_outil,
                    "nom_client" => $nom_utilisateur,
                    "date_fin" => $date_fin,
                    "date_debut" => $date_debut
                );

                array_push($employeeArr["body"], $e);
            }
            http_response_code(200);
            echo json_encode($employeeArr);
        }
        else{
            $emp_arr = array(
                "result" => true,
                "noreservation" => true
            );
            http_response_code(200);
            echo json_encode($emp_arr);
        }
    }
    
?>