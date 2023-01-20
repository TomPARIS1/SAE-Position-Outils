<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/outil.php';
    include_once '../../class/uui_key.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $items = new Outil($db);
    $keyitem = new UUI_key($db);

    $data = json_decode(file_get_contents("php://input"));

    $keyitem->UUID = $data->uui_key;
    $id_from_uuid = $keyitem->IsValidUUID();

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
        $stmt = $items->getOutilsFromCompte($id_from_uuid);
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
                    "id_etagere" => $id_etagere,
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