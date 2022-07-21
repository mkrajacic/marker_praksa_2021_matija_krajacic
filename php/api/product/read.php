<?php
    //access and content type
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once("connection.php");
    include_once("product.php");

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);

    $stmt = $product->read($db);
    $numrows = $stmt->rowCount();

    if($numrows>0) {
        $products_array = array();
        $products_array["records"]=array();

            while ($product_row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($product_row);

                $categories_array = array();
                $categories_query = "SELECT category_id AS category_id,name AS category_name FROM product_category INNER JOIN category ON category.id=product_category.category_id WHERE product_id=" . $id;
            
                $categories = $db->prepare($categories_query);
                $categories->execute();

                if($categories->rowCount()>0) {
                    while ($category_row = $categories->fetch(PDO::FETCH_ASSOC)) {
                        extract($category_row);

                        $category = array(
                            "id" => $category_id,
                            "name" => $category_name
                        );

                        array_push($categories_array,$category);
                    }
                }

                $brands_array = array();
                $brands_query = "SELECT brand.id AS brand_id,brand.name AS brand_name FROM brand INNER JOIN product ON product.brand_id=brand.id WHERE product.id=" . $id;
            
                $brands = $db->prepare($brands_query);
                $brands->execute();

                if($brands->rowCount()>0) {
                    while ($brand_row = $brands->fetch(PDO::FETCH_ASSOC)) {
                        extract($brand_row);

                        $brand = array(
                            "id" => $brand_id,
                            "name" => $brand_name
                        );

                        array_push($brands_array,$brand);
                    }
                }

                $product = array(
                    "id" => $id,
                    "name" => $name,
                    "brand" => $brands_array,
                    "description" => $description,
                    "price_base" => $price_base,
                    "discount" => $discount,
                    "price_final" => $price_final,
                    "available" => $available,
                    "forbidden" => $forbidden,
                    "special" => $special,
                    "active" => $active,
                    "categories" => $categories_array
                );

                array_push($products_array["records"],$product);
            }
            http_response_code(200);
            echo json_encode($products_array);
    }else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Nema pronađenih proizvoda!")
        );
    }
?>