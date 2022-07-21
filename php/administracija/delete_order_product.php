<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id']) && isset($_GET['oid'])) {
    $order_id = $_GET['oid'];
    $product_id = $_GET['id'];

    $query = "DELETE FROM product_order WHERE order_id = ? AND product_id = ?";
    $prepare = $connection->prepare($query);
    $prepare->bind_param('ii',$order_id,$product_id);

    if ($prepare->execute()) {
        echo "<p>Proizvod uspješno obrisan iz narudžbe!</p>";
        echo "<a href='edit_order_products.php?id=" . $order_id . "'>Povratak</a>";
    }
} else {
    echo "<p>Dogodila se pogreška! " . mysqli_error($connection) . "</p>";
    echo "<a href='edit_order_products.php?id=" . $order_id . "'>Povratak</a>";
}
include_once("footer.php");
?>