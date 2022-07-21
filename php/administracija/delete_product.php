<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "DELETE FROM product WHERE id = ?";
    $prepare = $connection->prepare($query);
    $prepare->bind_param('i',$product_id);

    if ($prepare->execute()) {

        if(isset($_GET['cid'])) {
            echo "<p>Proizvod uspješno obrisan!</p>";
            echo "<a style='padding-right:10px;' href='category_products.php?id=" . $_GET['cid'] . "'>Povratak</a>";
            echo "<a href='index.php'>Povratak na početnu stranicu</a>";
        }else{
            echo "<p>Proizvod uspješno obrisan!</p>";
            echo "<a style='padding-right:10px;' href='products.php'>Povratak</a>";
            echo "<a href='index.php'>Povratak na početnu stranicu</a>";
        }

    }
} else {

    if(isset($_GET['cid'])) {
        echo "<p>Dogodila se pogreška! " . mysqli_error($connection) . "</p>";
        echo "<a style='padding-right:10px;' href='category_products.php?id=" . $_GET['cid'] . "'>Povratak</a>";
        echo "<a href='index.php'>Povratak na početnu stranicu</a>";
    }else{
        
        echo "<p>Dogodila se pogreška! " . mysqli_error($connection) . "</p>";
        echo "<a style='padding-right:10px;' href='products.php'>Povratak</a>";
        echo "<a href='index.php'>Povratak na početnu stranicu</a>";
    }

}
include_once("footer.php");
?>