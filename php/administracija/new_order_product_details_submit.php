<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Dodaj količinu i cijenu</h1>";

    if (isset($_POST['prod']) && isset($_POST['ord'])) {
        $order_id = $_POST['ord'];
        $product_id = $_POST['prod'];
    }

    if (isset($_POST['submitted'])) {
        include_once("order_product_validation.php");

        if($pass == 1) {
            $new_order_product = $connection->prepare("INSERT into product_order (order_id,product_id,quantity,price) VALUES (?,?,?,?)");
            $new_order_product->bind_param('iiid', $order_id,$product_id,$quantity,$price);

            if ($new_order_product->execute()) {
                echo "<p>Podaci o proizvodu uspješno dodani!</p>";
                echo "<a style='display:padding-right:10px;' href='new_order_products.php?id=" . $order_id . "'>Dodaj još proizvoda</a><br>";
                echo "<a href='orders.php'>Povratak na narudžbe</a><br>";
                echo "<br><hr><br>";
             }else {
                echo "<p>Dogodila se pogreška! ";
                printf($new_order_product->error);
                echo "</p>";
                echo "<a style='padding-right:10px' href='new_order_products.php?id=" . $order_id . "'>Povratak</a><br>";
                echo "<a href='orders.php'>Povratak na narudžbe</a>";
                echo "<br><hr><br>";
             }
            }
    }
?>