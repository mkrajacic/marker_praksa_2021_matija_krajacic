<?php
$title = "Košarica";
include_once("header.php");

$getFields = array('deleted','updated');
generateMessage($getFields);

?>

<body>
    <div class="special-products">
        <h1>Proizvodi unutar kosarice</h1>
    </div>
    <div class='special'>
        <?php
        $session_id = session_id();

        if (!empty($session_id)) {

            $query = "SELECT id FROM cart WHERE session_id ='" . $session_id . "' LIMIT 1";

            if ($prep = mysqli_query($connection, $query)) {
                $rowcount = mysqli_num_rows($prep);
            }

            if ($rowcount > 0) {

                $session_row = mysqli_fetch_assoc($prep);
                $cart_id = $session_row['id'];

            }else {
                $cart_id = 0;
            } 

            if (isset($_POST['submitted'])) {
                $pass = 1;

                $field_names = array('cart_product', 'cart_quantity');

                foreach ($field_names as $field) {
                    ${$field} = "";
                    ${$field} = htmlentities(trim((int)$_POST["$field"]));
                }

                $errors = validate($field_names);

                if (sizeof($errors) > 0) {
                    $pass  = 0;
                }

                if ($pass == 1) {

                    $edit_cart_product = $connection->prepare("UPDATE product_cart SET quantity=? WHERE product_id=? AND cart_id=?");
                    $edit_cart_product->bind_param('iii', $cart_quantity, $cart_product, $cart_id);

                    if ($edit_cart_product->execute()) {
                        header("Location: cart.php?updated=1");
                    } else {
                        header("Location: cart.php?updated=2");
                    }
                } else {
                    header("Location: cart.php?updated=2");
                }
            }

        ?>

            <div class="sort">
                <p><a href="index.php">Povratak</a></p>
                <?php
                $sum = getJoinResults("SELECT SUM(product.price_final*product_cart.quantity) AS 'total' FROM product INNER JOIN product_cart ON product_cart.product_id = product.id WHERE product_cart.cart_id=" . $cart_id, $connection);

                if ($sum) {
                    while ($sum_row = $sum->fetch_assoc()) {
                        $total = $sum_row['total'];
                        $_SESSION['total'] = $total;
                    }
                }
                ?>
                <br>
                <?php
                if (isset($total)) {        ?>
                    <p>Ukupna cijena: <br></p>
                    <span><?php echo $total ?>.kn</span>
                    <br><br>
                    <p><a href="new_order.php"><button type="submit" class="cart_button" style="background-color: #4a5673cc;">Završi kupovinu</button></a></p>
                <?php
                } else {
                    echo "</div>";
                    echo "<div class='special_product>";
                    echo "<div class='cart_warning'>";
                    echo "<p class='no-results'>Nemate proizvoda u košarici, <a href='index.php'>dodajte ih!</a> ";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>

            <?php
            $counter = 0;
            $ordered_products = array('product_id' => '', 'name' => '', 'quantity' => '', 'price' => '');
            $products = getJoinResults("SELECT product_cart.cart_id,product.id,product.name,product_cart.quantity,GROUP_CONCAT(product_image.photo SEPARATOR ', ') AS 'photos',product.price_final*product_cart.quantity AS 'total' FROM product INNER JOIN product_image ON product.id = product_image.product_id INNER JOIN product_cart ON product_cart.product_id = product.id WHERE product_cart.cart_id=" . $cart_id . " GROUP BY product.id", $connection);

            if ($products) {
                while ($product_row = $products->fetch_assoc()) {
            ?>
                    <div class="special_product">
                        <?php $images = explode(", ", $product_row['photos']);    ?>
                        <img class="special_image" src="fotografije/<?php echo $images[0] ?>">
                        <h3 class="product_name">
                            <?php echo $product_row['name'] ?>
                        </h3>
                        <h3 class="product_discount">
                            Količina: <?php echo $product_row['quantity'] ?>
                        </h3>
                        <h3 class="product_price">
                            <?php echo $product_row['total'] ?>kn
                        </h3>
                        <form method="post" action="" class="cart_form">
                            <input type='hidden' id='submitted' name='submitted'>
                            <input type='hidden' id='cart_product' name='cart_product' value="<?php echo $product_row['id'] ?>">
                            <input type='number' id='cart_quantity' name='cart_quantity' required>
                            <button type="submit" class="cart_button">Uredi količinu</button>
                        </form>
                        <a style="display: table-header-group;" href="delete_cart_product.php?id=<?php echo $product_row['id'] ?>&cid=<?php echo $cart_id ?>"><button type="button" class="button_delete_cart_product">Ukloni proizvod</button></a>
                    </div>
        <?php
                    $ordered_products[$counter]['product_id'] = $product_row['id'];
                    $ordered_products[$counter]['name'] = $product_row['name'];
                    $ordered_products[$counter]['quantity'] = $product_row['quantity'];
                    $ordered_products[$counter]['price'] = $product_row['total'];
                    $counter++;
                }
            }
            $_SESSION['count_products'] = $counter;
            $_SESSION['ordered_products'] = $ordered_products;
        }
        ?>
    </div>
</body>

</html>