<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_POST['submitted'])) {
    
    include_once("product_validation.php");

    if($pass == 1) {

    $new_product = $connection->prepare("INSERT into product (name,brand_id,description,price_base,discount,price_final,available,forbidden,special,active) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $new_product->bind_param('sisdidiiii', $name,$brand_id,$product_description,$price_base,$discount,$price_final,$available,$forbidden,$special,$active);
    if ($new_product->execute()) {

        $product_id = mysqli_insert_id($connection);
        $new_product_category = $connection->prepare("INSERT into product_category VALUES (?,?)");
        $new_product_category->bind_param('ii', $product_id,$product_category);
            if ($new_product_category->execute()) {
                echo "<p>Proizvod uspješno dodan!</p>";
                echo "<a href='index.php'>Povratak</a>";
            }
            else {
                echo "<p>Dogodila se pogreška! ";
                printf($new_product_category->error);
                echo "</p>";
                echo "<a href='index.php'>Povratak</a>";
            }
    }
    else {
        echo "<p>Dogodila se pogreška! ";
        printf($new_product->error);
        echo "</p>";
        echo "<a href='index.php'>Povratak</a>";
    }
        }else {
            echo "<p class='error'>";
            echo $error;
            echo "</p>";
            echo "<hr><br>";
        }
}
include_once("footer.php");
?>