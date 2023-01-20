<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/outil.php';
    include_once '../../class/uui_key.php';
    include_once '../../class/atelier.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $items = new Outil($db);
    $keyitem = new UUI_key($db);
    $atelieritem = new Atelier($db);

    $data = json_decode(file_get_contents("php://input"));

    $keyitem->UUID = $data->uui_key;
    $id_from_uuid = $keyitem->IsValidUUID();

    $atelier_id = $data->atelier_id;
    $atelieritem->id_atelier = $atelier_id;
    $atelieritem->getAtelierFromId();

    $sortmode = $data->sortmode;

    if ($id_from_uuid==null || $atelieritem->id_compte!=$id_from_uuid)
    {
        $emp_arr = array(
            "result" => false
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else
    {
        $stmt;
        if ($sortmode==0)
            $stmt = $items->getOutilsFromAtelierUseOrder($atelier_id);
        else
        $stmt = $items->getOutilsFromAtelierReservationOrder($atelier_id);

        $itemCount = $stmt->rowCount();
        
        if($itemCount > 0){
            
            $employeeArr = array();
            $employeeArr["body"] = array();
            $employeeArr["itemCount"] = $itemCount;
            $employeeArr["result"] = true;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "id" => $id,
                    "atelier_id" => $atelier_id,
                    "type" => $type,
                    "nbr_utilisations" => $nbr_utilisations,
                    "x" => $x,
                    "y" => $y
                );

                array_push($employeeArr["body"], $e);
            }
            http_response_code(200);
            echo json_encode($employeeArr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No record found.")
            );
        }
    }
    
?>