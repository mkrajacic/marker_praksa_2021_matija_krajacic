<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM product WHERE id=" . $product_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    if ($result) {
        while ($row = $result->fetch_assoc()) {

            if(isset($_GET['cid'])) {
                echo "<p>Jeste li sigurni da želite obrisati proizvod " . $row['name'] .  " ?</p>";
                echo "<a style='padding-right:5px' href='delete_product.php?id=" . $product_id . "&cid=" . $_GET['cid'] . "'>Obriši</a>";
                echo "<a href='category_products.php?id=" . $_GET['cid'] . "'>Povratak</a>";
            }else {
                echo "<p>Jeste li sigurni da želite obrisati proizvod " . $row['name'] .  " ?</p>";
                echo "<a style='padding-right:5px' href='delete_product.php?id=" . $product_id . "'>Obriši</a>";
                echo "<a href='products.php'>Povratak</a>";
            }

        }
    }
} else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a href='index.php'>Povratak</a>";
}
include_once("footer.php");
?>