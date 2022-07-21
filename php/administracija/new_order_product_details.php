<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Dodaj količinu i cijenu</h1>";

        if (isset($_GET['oid'])) {
            $product_id = $_POST['product'];
            $order_id = $_GET['oid'];

        }else {
            echo "<p>Dogodila se pogreška! ";
            echo "</p>";
            echo "<a href='new_order_products.php?id=" . $order_id . "'>Povratak</a><br>";
            echo "<a href='orders.php'>Povratak na narudžbe</a>";
            echo "<br><hr><br>";
        }

echo "<form method='post' action='new_order_product_details_submit.php'>";
        echo "<input type='hidden' id='submitted' name='submitted'>";
        echo "<input type='hidden' id='prod' name='prod' value=" . $product_id . ">";
        echo "<input type='hidden' id='ord' name='ord' value=" . $order_id . ">";
    echo "<label for='quantity'>Količina:</label><br>";
        echo "<input type='number' id='quantity' name='quantity' required><br>";
    echo "<label for='price'>Cijena:</label><br>";
        echo "<input type='number' id='price' name='price' required><br>";
        echo "<br><input type='submit' value='Dodaj'>";
echo "</form>";

include_once("footer.php");
?>