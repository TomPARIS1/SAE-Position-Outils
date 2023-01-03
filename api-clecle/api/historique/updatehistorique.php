<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/historique.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Historique($db);
    $item->id_historique = isset($_GET['id_historique']) ? $_GET['id_historique'] : die();
    $item->getHistoriqueFromId();

    if($item->x != null){

        if (isset($_GET['id_outil']))
        {
            $item->id_outil = $_GET['id_outil'];
        }

        if (isset($_GET['x']))
        {
            $item->x = $_GET['x'];
        }

        if (isset($_GET['y']))
        {
            $item->y = $_GET['y'];
        }

        if (isset($_GET['date']))
        {
            $item->date = $_GET['date'];
        }

        $result = $item->updateHistorique();

        $emp_arr = array(
            "id_historique" =>  $item->id_historique,
            "x" => $item->x,
            "y" => $item->y,
            "date" => $item->date,
            "result" => $result
        );

        http_response_code(200);
        echo json_encode($emp_arr);
    }

    else{
        http_response_code(404);
        echo json_encode("History not found.");
    }
?>