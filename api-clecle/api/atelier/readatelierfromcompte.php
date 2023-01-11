<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/atelier.php';
    include_once '../../class/compte.php';
    include_once '../../class/uui_key.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';
    
    $data = json_decode(file_get_contents("php://input"));

    $items = new Atelier($db);
    $itemc = new Compte($db);
    $keyitem = new UUI_key($db);
    
    $keyitem->UUID = $data->uui_key;
    $itemc = $keyitem->checkUUID();
    
    if ($itemc->id==null)
    {
        $emp_arr = array(
            "result" => false
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else
    {
        $stmt = $items->getAtelierFromCompte($itemc->id);
        $itemCount = $stmt->rowCount();
        
        if($itemCount > 0){
            
            $employeeArr = array();
            $employeeArr["body"] = array();
            $employeeArr["itemCount"] = $itemCount;
            $employeeArr["result"] = true;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    
                    "id_compte" => $id_compte,
                    "id_atelier" => $id_atelier,
                    "x" => $x,
                    "y" => $y,
                    "plan" => $plan
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