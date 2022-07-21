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
$errors = array("message" => "Greška pri uređivanju narudžbi: ");
$errors["update_failed"] = array();
$succeeded = array("message"=>"Uspješno uređene narudžbe: ");
$succeeded["update_success"] = array();
$success = 1;

if (!is_array($data_all)) {
    $data_all = [$data_all];
}

foreach ($data_all as $data) {

    $products_success = 1;

    if (
        isset($data->id) &&
        isset($data->name) &&
        isset($data->surname) &&
        isset($data->address) &&
        isset($data->email) &&
        isset($data->status)
    ){
        
    $order->id = $data->id;
    $order->name = $data->name;
    $order->surname = $data->surname;
    $order->address = $data->address;
    $order->email = $data->email;
    $order->status = $data->status;

    if($order->update($db)) {

        if(isset($data->products)) {
            foreach($data->products as $product) {
                if(
                    isset($product->id) &&
                    isset($product->quantity) &&
                    isset($product->price)
                ) {
                    $product_id=htmlspecialchars(strip_tags($product->id));
                    $product_quantity=htmlspecialchars(strip_tags($product->quantity));
                    $product_price=htmlspecialchars(strip_tags($product->price));

                    $products_query = "INSERT INTO product_order (order_id,product_id,quantity,price) VALUES (?,?,?,?)";
                    $insert_products_order = $db->prepare($products_query);
                    $insert_products_order->bindParam(1, $data->id);
                    $insert_products_order->bindParam(2, $product_id);
                    $insert_products_order->bindParam(3, $product_quantity);
                    $insert_products_order->bindParam(4, $product_price);
        
                    if($insert_products_order->execute()) {    
                        $products_success=1;
                }else {
                    array_push($errors["update_failed"], "Proizvod " . $product_id);
                    $success = 0;
                    $products_success = 0;
                }
        }else {
            http_response_code(400);
            array_push($errors,"Neispravni podaci!");
            $success = 0;
        }
        }

       if($products_success==1) {
            http_response_code(200);
            array_push($succeeded["update_success"], "Narudžba " . $order->id);
       }
        
    }else {
        http_response_code(400);
        array_push($errors,"Neispravni podaci!");
        $success = 0;
    }
    }else {
        http_response_code(503);
        $success = 0;
        array_push($errors["update_failed"], "Narudžba " . $data->id);
    }

}else {
    http_response_code(400);
    $success = 0;
    array_push($errors,"Neispravni podaci!");
}
}

if(sizeof($errors["update_failed"])==0 && $success==1) {
    echo json_encode(array("message"=>"Narudžba/e uspješno uređena/e")); 
}

if(sizeof($errors["update_failed"])>0 || sizeof($errors)>0 && $success==0) {
        echo json_encode($errors);
        if(sizeof($succeeded["update_success"])>0) {
                echo json_encode($succeeded); 
        }
}
?>