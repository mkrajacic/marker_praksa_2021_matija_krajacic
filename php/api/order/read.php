<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once("connection.php");
    include_once("order.php");

    $database = new Database();
    $db = $database->getConnection();

    $order = new Order($db);

    $stmt = $order->read($db);
    $numrows = $stmt->rowCount();

    if($numrows>0) {
        $orders_array = array();
        $orders_array["records"]=array();

            while ($order_row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($order_row);

                $products_array = array();
                $products_query = "SELECT product_id,name AS product_name,quantity,price FROM product_order INNER JOIN product ON product.id=product_order.product_id WHERE order_id=" . $id;
            
                $products = $db->prepare($products_query);
                $products->execute();

                if($products->rowCount()>0) {
                    while ($product_row = $products->fetch(PDO::FETCH_ASSOC)) {
                        extract($product_row);

                        $product = array(
                            "id" => $product_id,
                            "name" => $product_name,
                            "quantity" => $quantity,
                            "price" => $price
                        );

                        array_push($products_array,$product);
                    }
                }

                $order = array(
                    "id" => $id,
                    "name" => $name,
                    "surname" => $surname,
                    "address" => $address,
                    "email" => $email,
                    "time_created" => $time_created,
                    "status" => $status,
                    "products" => $products_array
                );

                array_push($orders_array["records"],$order);
            }
            http_response_code(200);
            echo json_encode($orders_array);
    }else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Nema pronađenih narudžbi!")
        );
    }
