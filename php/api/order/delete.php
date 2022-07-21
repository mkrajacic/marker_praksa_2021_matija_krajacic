<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once("connection.php");
    include_once("order.php");

    $database = new Database();
    $db = $database->getConnection();

    $order = new Order($db);

    $data_all = json_decode(file_get_contents("php://input"));
    $errors = array("message" => "Greška pri brisanju narudžbi: ");
    $errors["delete_failed"] = array();
    $succeeded = array("message"=>"Uspješno obrisane narudžbe: ");
    $succeeded["delete_success"] = array();
    $success = 1;

if (!is_array($data_all)) {
    $data_all = [$data_all];
}

foreach ($data_all as $data) {

        if(
            isset($data->id)
        ){

            $order->id = $data->id;

            $products_query = "DELETE FROM product_order WHERE order_id=?";
            $delete_products = $db->prepare($products_query);
            $delete_products->bindParam(1, $data->id);
            $delete_products->execute();

        if($order->delete($db)) {
            http_response_code(200);
            array_push($succeeded["delete_success"],$order->id);
        }else{
            http_response_code(503);
            $success = 0;
            array_push($errors["delete_failed"], $order->id);
        }
    }else {
        http_response_code(400);
        $success = 0;
        array_push($errors,"Neispravni podaci!");
    }
}

if(sizeof($errors["delete_failed"])==0 && $success==1) {
    echo json_encode(array("message"=>"Narudžba/e uspješno obrisana/e")); 
}

if(sizeof($errors["delete_failed"])>0 || sizeof($errors)>0 && $success==0) {
        echo json_encode($errors);
        if(sizeof($succeeded["delete_success"])>0) {
                echo json_encode($succeeded); 
        }
}
?>