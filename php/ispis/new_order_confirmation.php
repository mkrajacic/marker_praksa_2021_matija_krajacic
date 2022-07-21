<?php
$title = "Potvrda narudžbe";
include_once("header.php");

if (isset($_POST['submitted'])) {
    $pass = 1;

    $field_names = array('name', 'surname', 'address', 'email');

    foreach ($field_names as $field) {
        ${$field} = "";
        ${$field} = htmlentities(trim($_POST["$field"]));
    }

    $errors = validate($field_names);

    if (sizeof($errors) > 0) {
        $pass  = 0;
    }
}

foreach ($field_names as $return_field) {
    $_SESSION["return_" . $return_field] = ${$return_field};
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

                $labels = array('Ime: ', 'Prezime: ', 'Email: ', 'Adresa: ');
                $count = 0;
                foreach ($field_names as $value) {
            ?>
                    <h3 class="product_price">
                        <span style="color:#888888"><?php echo $labels[$count] ?></span><?php echo ${$value} ?>
                    </h3>
                <?php
                    $count++;
                }   ?>
                <br>
                <hr><br>
                <?php if (isset($_SESSION['ordered_products']) && isset($_SESSION['total']) && isset($_SESSION['count_products'])) {

                    $count = $_SESSION['count_products'];
                    $ordered_products = $_SESSION['ordered_products'];
                    $total = $_SESSION['total'];

                    for ($i = 0; $i < $count; $i++) {   ?>
                        <h3 class="product_name">
                            <?php echo $i + 1 . ". " . $ordered_products[$i]['name'] ?>
                        </h3>
                        <h3 class="product_discount">
                            <span style="color:#61619c6b">Količina: </span><?php echo $ordered_products[$i]['quantity'] ?>
                        </h3>
                        <h3 class="product_price">
                            <span style="color:#888888">Iznos: </span><?php echo $ordered_products[$i]['price'] ?>kn
                        </h3>
                <?php
                    }
                } else {
                    throwError();
                }
                echo "<br><hr><br>";    ?>

                <h3 class="product_discount" style="font-size:24px; color:#6e4a73;">
                    Ukupan iznos: <?php echo $total ?>kn
                </h3>
                <form method='post' action='new_order_submit.php'>
                    <input type='hidden' id='order_submitted' name='order_submitted'>
                    <?php
                    foreach ($field_names as $value) {  ?>
                        <input type='hidden' id='<?php echo $value ?>_hidden' name='<?php echo $value ?>_hidden' value='<?php echo ${$value} ?>'>
                    <?php
                    }
                    ?>
                    <p style="text-align: center;"><button type="submit" class="cart_button">Potvrdi narudžbu</button></p>
                </form>
            <?php
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