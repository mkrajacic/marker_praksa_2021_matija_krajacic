<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id']) && isset($_GET['oid'])) {
    $product_id = $_GET['id'];
    $order_id = $_GET['oid'];

    $query = "SELECT * FROM product WHERE id=" . $product_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    if ($result) {
        while ($row = $result->fetch_assoc()) {

                echo "<p>Jeste li sigurni da želite obrisati proizvod " . $row['name'] .  " iz narudžbe #" . $order_id .  "?</p>";
                echo "<a style='padding-right:5px' href='delete_order_product.php?id=" . $product_id . "&oid=" . $order_id . "'>Obriši</a>";
                echo "<a href='edit_order_products.php?id=" . $order_id . "'>Povratak</a>";

        }
    }
} else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a href='edit_order_products.php?id=" . $order_id . "'>Povratak</a>";
}
include_once("footer.php");
?>