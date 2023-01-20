<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/compte.php';
    include_once '../../class/uui_key.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $item = new Compte($db);
    
    $data = json_decode(file_get_contents("php://input"));

    $hashed = hash("sha512", $data->mdp);
    $item->nom = $data->nom;

    if ($item->findCompteByName()==null)
    {
        $emp_arr = array(
            "codeErr" => "2" // L'adresse mail n'est pas enregistrée
        );
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else if($item->mdp!==$hashed){
        $emp_arr = array(
            "codeErr" => "1" // Le mot de passe est faux
        );
        http_response_code(200);
        echo json_encode($emp_arr);
    } else{
        $key = new UUI_key($db);
        $key->id_compte = $item->id;
        $key->createUUID();

        $emp_arr = array(
            "uui_key" =>  $key->UUID,
            "codeErr" => "0" 
        );
        http_response_code(200);
        echo json_encode($emp_arr);
    }
?>