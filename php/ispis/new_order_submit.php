<?php
$title = "Potvrda narudžbe";
include_once("header.php");

if (isset($_POST['order_submitted'])) {
    $pass = 1;

    $field_names = array('name_hidden', 'surname_hidden', 'address_hidden', 'email_hidden');

    foreach ($field_names as $field) {
        ${$field} = "";
        ${$field} = htmlentities(trim($_POST["$field"]));
    }

    $errors = validate($field_names);

    if (sizeof($errors) > 0) {
        $pass  = 0;
    }
}   

?>

<body>
    <div class="special-products">
        <h1>Potvrda narudzbe</h1>
    </div>
    <div class='special'>
        <div class="sort">
            <p><a href="index.php">Početna stranica</a></p><br>
            <a href="new_order.php">Povratak na upis podataka</a></p>
            <p><a href="cart.php">Povratak na košaricu</a></p>
        </div>
        <div class="special_product">
            <?php
            if ($pass == 1) {
                $order_pass = 1;
                if (isset($_SESSION['ordered_products']) && isset($_SESSION['total']) && isset($_SESSION['count_products'])) {

                    $new_order = $connection->prepare("INSERT into orders (name,surname,address,email) VALUES (?,?,?,?)");
                    $new_order->bind_param('ssss', $name_hidden, $surname_hidden, $address_hidden, $email_hidden);

                    if ($new_order->execute()) {
                        $ordered_products_pass = 1;
                        $count = $_SESSION['count_products'];
                        $ordered_products = $_SESSION['ordered_products'];

                        $order_id = mysqli_insert_id($connection);

                        for ($i = 0; $i < $count; $i++) {

                            $product_id = $ordered_products[$i]['product_id'];
                            $quantity = $ordered_products[$i]['quantity'];
                            $price = $ordered_products[$i]['price'];

                            $new_product_order = $connection->prepare("INSERT into product_order VALUES (?,?,?,?)");
                            $new_product_order->bind_param('iiid', $order_id, $product_id, $quantity, $price);

                            if ($new_product_order->execute()) {
                                if ($ordered_products_pass == 1 && $order_pass == 1) {
                                     header("Location: order_success.php");
                                }
                            } else {
                                $ordered_products_pass = 0;
                                echo "<div class='cart_failure'>";
                                echo "<p class='no-results'>Greška pri dodavanju proizvoda u narudžbu!";
                                printf($new_product_order->error);
                                echo "</p>";
                                echo "</div>";
                            }
                        }
                    } else {
                        $order_pass = 0;
                        echo "<div class='cart_failure'>";
                        echo "<p class='no-results'>Greška pri kreiranju narudžbe!";
                        printf($new_order->error);
                        echo "</p>";
                        echo "</div>";
                    }
                }
            } else {
                echo "<div class='cart_failure'>";
                foreach ($errors as $err) {
                    echo "<p class='no-results'>" . $err . "</p>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>