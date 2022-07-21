<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once("connection.php");
    include_once("product.php");

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);

    $data_all = json_decode(file_get_contents("php://input"));
    $errors = array("message" => "Greška pri brisanju proizvoda: ");
    $errors["delete_failed"] = array();
    $succeeded = array("message"=>"Uspješno obrisani proizvodi: ");
    $succeeded["delete_success"] = array();
    $success = 1;

if (!is_array($data_all)) {
    $data_all = [$data_all];
}

foreach ($data_all as $data) {

    if(
        isset($data->id)
    ){

    $product->id = $data->id;

    if($product->delete($db)) {
        http_response_code(200);
        array_push($succeeded["delete_success"],$product->id);
    }else{
        http_response_code(503);
        $success = 0;
        array_push($errors["delete_failed"], $product->id);
    }
}else {
    http_response_code(400);
    $success = 0;
    array_push($errors,"Neispravni podaci!");
}
}

if(sizeof($errors["delete_failed"])==0 && $success==1) {
    echo json_encode(array("message"=>"Proizvod/i uspješno obrisan/i")); 
}

if(sizeof($errors["delete_failed"])>0) {
        echo json_encode($errors);
        if(sizeof($succeeded["delete_success"])>0) {
                echo json_encode($succeeded); 
        }
}
?>