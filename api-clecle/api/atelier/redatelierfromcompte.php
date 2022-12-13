<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/atelier.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Atelier($db);

    $id_compte = isset($_GET['id_compte']) ? $_GET['id_compte'] : die();

    $stmt = $items->getAtelierFromCompte($id_compte);
    $itemCount = $stmt->rowCount();
    
    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

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
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
    
?>