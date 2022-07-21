<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Uredi proizvode narudžbe</h1>";

    if(isset($_GET['id'])) {

        $order_id = $_GET['id'];

    }else{
        echo "<p>Dogodila se pogreška!</p>";
        echo "<a href='orders.php'>Povratak</a>";
    }

    $query = "SELECT product_order.order_id AS order_id, product_order.product_id AS product_id, product.name, product_order.quantity, product_order.price FROM product_order INNER JOIN product ON product_order.product_id = product.id WHERE order_id=" . $order_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);

    echo "<h3 style='display:inline-block;'>Proizvodi: </h3>";
    echo "<a style='padding-left:10px; padding-right:10px' href='new_order_products.php?id=" . $order_id . "'>Dodaj proizvod</a>";
    if ($result) {
        while ($row = $result->fetch_assoc()) {
        echo "<br><p style='display:inline-block'>";
            echo $row['name'];
        echo "</p>";
        echo "<a style='padding-left:10px; padding-right:10px' href='edit_order_products_details.php?id=" . $row['product_id'] . "&oid=" . $order_id . "'>Uredi količinu i cijenu</a>";
        echo "<a style='padding-right:10px' href='delete_order_products_confirmation.php?id=" . $row['product_id'] . "&oid=" . $order_id . "'>Obriši</a>";
        echo "<hr>";
        }
    }

    include_once("footer.php");
?>