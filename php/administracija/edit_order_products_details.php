<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Uredi količinu i cijenu</h1>";

    if (isset($_GET['id']) && isset($_GET['oid'])) {
        $product_id = $_GET['id'];
        $order_id = $_GET['oid'];

        if (isset($_POST['submitted'])) {
            include_once("order_product_validation.php");

            if($pass == 1) {
                $edit_order_product = $connection->prepare("UPDATE product_order SET quantity=?, price=? WHERE order_id=? AND product_id=?");
                $edit_order_product->bind_param('idii', $quantity,$price,$order_id,$product_id);

                if ($edit_order_product->execute()) {
                    echo "<p>Podaci o proizvodu uspješno uređeni!</p>";
                    echo "<a href='edit_order_products.php?id=" . $order_id . "'>Povratak</a>";
                    echo "<br><hr><br>";
                 }else {
                    echo "<p>Dogodila se pogreška! ";
                    printf($edit_order_product->error);
                    echo "</p>";
                    echo "<a href='edit_order_products.php?id=" . $order_id . "'>Povratak</a>";
                    echo "<br><hr><br>";
                 }
                }
        }

        $query = "SELECT * FROM product_order WHERE order_id=" . $order_id . " AND product_id=" . $product_id;
        $result = $connection->query($query, MYSQLI_STORE_RESULT);
        
    if ($result) {
        while ($row = $result->fetch_assoc()) {
echo "<form method='post' action=''>";
        echo "<input type='hidden' id='submitted' name='submitted'>";
    echo "<label for='quantity'>Količina:</label><br>";
        echo "<input type='number' id='quantity' name='quantity' value='" . $row['quantity'] . "' required><br>";
    echo "<label for='price'>Cijena:</label><br>";
        echo "<input type='number' id='price' name='price' value='" . $row['price'] . "' required><br>";
        echo "<br><input type='submit' value='Uredi'>";
echo "</form>";
        }
    }
}else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a href='edit_order_products.php?id=" . $order_id . "'>Povratak</a>";
}

include_once("footer.php");
?>