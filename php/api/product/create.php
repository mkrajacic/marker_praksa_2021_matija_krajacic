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

if (!is_array($data_all)) {
    $data_all = [$data_all];
}

foreach ($data_all as $data) {

    if (
        isset($data->name) &&
        isset($data->brand_id) &&
        isset($data->description) &&
        isset($data->price_base) &&
        isset($data->discount) &&
        isset($data->price_final) &&
        isset($data->available) &&
        isset($data->forbidden) &&
        isset($data->special) &&
        isset($data->active)
    ) {

        $product->name = $data->name;
        $product->brand_id = $data->brand_id;
        $product->description = $data->description;
        $product->price_base = $data->price_base;
        $product->discount = $data->discount;
        $product->price_final = $data->price_final;
        $product->available = $data->available;
        $product->forbidden = $data->forbidden;
        $product->special = $data->special;
        $product->active = $data->active;

        if ($product->create($db)) {
            http_response_code(201);
            echo json_encode(array("message" => "Proizvod uspješno kreiran"));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Greška pri kreiranju proizvoda"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Neispravni podaci!"));
    }
}
