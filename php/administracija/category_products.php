<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $query = "SELECT * FROM product_category WHERE category_id=" . $category_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    $product_id = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
                array_push($product_id,$row['product_id']);
        }
    }

    foreach ($product_id as $pid) {
        $product_query = "SELECT * FROM product WHERE id=" . $pid;
        $product = $connection->query($product_query, MYSQLI_STORE_RESULT);
        if($product) {
            while ($product_row = $product->fetch_assoc()) {
                echo "<h3 style='display:inline-block; padding-right:10px;'>";
                echo $product_row['name'];
                echo "</h3>";
                echo "<a style='padding-right:5px;'  href='delete_product_confirmation.php?id=" . $product_row['id'] . "&cid=" . $category_id . "'><button type='button' class='delete_button'>Obriši</button></a>";
                echo "<a href='edit_product.php?id=" . $product_row['id'] . "&cid=" . $category_id . "&bid=" . $product_row['brand_id'] . "'><button type='button' class='edit_button'>Uredi</button></a>";
                echo "<p>";
                echo $product_row['description'];
                echo "</p>";
                echo "<h5 style='display:inline-block; padding-right:5px;'>Osnovna cijena:</h5>";
                echo $product_row['price_base'] . "kn";
                echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Popust:</h5>";
                echo $product_row['discount'] . "%";
                echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Finalna cijena:</h5>";
                echo $product_row['price_final']. "kn";
                echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Dostupno:</h5>";
                echo $product_row['available'];
                echo "<br>";
                echo "<hr>";
            }
        }
    }

    echo "<br><a href='index.php'>Povratak</a>";

} else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a href='index.php'>Povratak</a>";
}
include_once("footer.php");
?>