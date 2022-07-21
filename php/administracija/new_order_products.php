<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Dodaj proizvode narudžbe</h1>";

    if(isset($_GET['id'])) {

        $order_id = $_GET['id'];

    }else{
        echo "<p>Dogodila se pogreška!</p>";
        echo "<a href='orders.php'>Povratak</a>";
    }

    $query = "SELECT * FROM product ORDER BY id" ;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);

    echo "<h3>Proizvodi: </h3>";
echo "<form method='post' action='new_order_product_details.php?oid=" . $order_id . "'>";
    echo "<select name='product' id='product'>";
            echo "<option value='0' selected>Odaberite proizvod...</option>";
            while ($row = $result->fetch_assoc()) {
                    echo "<option value='" .  $row['id'] . "'>" . $row['name'] . "</option>";       
            }
    echo "</select><br>";
    echo "<br><input type='submit' value='Dodaj'>";
echo "</form>";

    include_once("footer.php");
?>