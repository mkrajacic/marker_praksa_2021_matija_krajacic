<?php
$title = "Detalji o proizvodu";
include_once("header.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $product = getJoinResults("SELECT product.id,product.name,product.description,GROUP_CONCAT(DISTINCT(product_image.photo) SEPARATOR ', ') AS 'photos',product.discount,product.price_final,GROUP_CONCAT(DISTINCT(category.name) SEPARATOR ', ') AS 'categories' FROM product INNER JOIN product_image ON product.id = product_image.product_id INNER JOIN product_category ON product_category.product_id = product.id INNER JOIN category ON category.id = product_category.category_id WHERE product.id=" . $product_id . " GROUP BY product.id", $connection);
} else {
    throwError();
}

if (isset($_POST['submitted'])) {
    $pass = 1;

    $cart_product = "";
    $cart_quantity = "";

    $field_names = array('cart_product','cart_quantity');

    foreach ($field_names as $field) {
        ${$field} = htmlentities(trim((int)$_POST["$field"]));
    }

    $errors = validate($field_names);

    if (sizeof($errors) > 0) {
        $pass  = 0;
    }

    if ($pass == 1) {
        $cart_success = 1;
        $session_id = session_id();

        $query = "SELECT id FROM cart WHERE session_id ='" . $session_id . "' LIMIT 1";

        if($prep = mysqli_query($connection,$query)) {
            $rowcount = mysqli_num_rows($prep);
        }

        if ($rowcount > 0) {

            $session_row = mysqli_fetch_assoc($prep);
            $cart_id = $session_row['id'];

            $product_in_cart = "SELECT cart_id FROM product_cart WHERE cart_id =" . $cart_id . " AND product_id=" . $cart_product;

            if($prod = mysqli_query($connection,$product_in_cart)) {
                $prodcount = mysqli_num_rows($prod);
            }
    
            if ($prodcount > 0) {

                $update_cart_products = $connection->prepare("UPDATE product_cart SET quantity=? WHERE product_id=? AND cart_id=?");
                $update_cart_products->bind_param('iii', $cart_quantity,$cart_product,$cart_id);
    
                if ($update_cart_products->execute()) {
                    if ($cart_success == 1) {
                        echo "<div class='cart_success'>";
                        echo "<p class='no-results'>Proizvod uspješno dodan u košaricu! ";
                        echo "</div>";
                    }
                } else {
                    $cart_success = 0;
                    echo "<div class='cart_failure'>";
                    echo "<p class='no-results'>Dogodila se pogreška pri kreiranju košarice! ";
                    printf($update_cart_products->error);
                    echo "</p>";
                    echo "</div>";
                }
            }else {

                $new_cart_products = $connection->prepare("INSERT into product_cart VALUES (?,?,?)");
                $new_cart_products->bind_param('iii', $cart_id, $cart_product, $cart_quantity);
    
                if ($new_cart_products->execute()) {
                    if ($cart_success == 1) {
                        echo "<div class='cart_success'>";
                        echo "<p class='no-results'>Proizvod uspješno dodan u košaricu! ";
                        echo "</div>";
                    }
                } else {
                    $cart_success = 0;
                    echo "<div class='cart_failure'>";
                    echo "<p class='no-results'>Dogodila se pogreška pri kreiranju košarice! ";
                    printf($new_cart_products->error);
                    echo "</p>";
                    echo "</div>";
                }
            }




        } else {
            $new_cart = $connection->prepare("INSERT into cart (session_id) VALUES (?)");
            $new_cart->bind_param('s', $session_id);

            if ($new_cart->execute()) {

                $cart_id = mysqli_insert_id($connection);
                $new_cart_products = $connection->prepare("INSERT into product_cart VALUES (?,?,?)");
                $new_cart_products->bind_param('iii', $cart_id, $cart_product, $cart_quantity);

                if ($new_cart_products->execute()) {
                    if ($cart_success == 1) {
                        echo "<div class='cart_success'>";
                        echo "<p class='no-results'>Proizvod uspješno dodan u košaricu! ";
                        echo "</div>";
                    }
                }
            } else {
                $cart_success = 0;
                echo "<div class='cart_failure'>";
                echo "<p class='no-results'>Dogodila se pogreška pri kreiranju košarice! ";
                printf($new_cart->error);
                echo "</p>";
                echo "</div>";
            }
        }
    }else {
        echo "<div class='cart_failure'>";
        foreach ($errors as $err) {
            echo "<p class='no-results'>" . $err . "</p>";
        }
        echo "</div>";
    }
}

?>

<body>
    <div class="special-products">
        <h1>Detalji o proizvodu<span class="cart"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;</a></span></h1>
    </div>
    <div class='special'>
        <div class="sort">
            <p><a href="index.php">Povratak</a></p>
        </div>
        <?php
        if ($product) {
                $product_row = mysqli_fetch_assoc($product);
        ?>
                <div class="special_product">
                    <?php

                    $images = explode(", ", $product_row['photos']);
                    $categories = explode(", ", $product_row['categories']);

                    foreach ($images as $img) {

                    ?>
                        <img class="special_image" src="fotografije/<?php echo $img ?>">
                    <?php    }  ?>
                    <h3 class='product_name'>
                        <?php echo $product_row['name'] ?>
                    </h3>
                    <h3 class='product_price'>Opis:</h3>
                    <p class='description'>
                        <?php echo $product_row['description'] ?>
                    </p>
                    <h3 class='product_price'>Kategorije:</h3>
                    <?php
                    foreach ($categories as $cat) { ?>
                        <p class="categories">
                            <?php echo $cat ?>
                        </p>
                    <?php
                    }
                    ?>
                    <h3 class='product_discount'>
                        <?php echo $product_row['discount'] ?>% popusta
                    </h3>
                    <h3 class='product_price'>
                        <?php echo $product_row['price_final'] ?>kn
                    </h3>
                    <form method="post" action="" class="cart_form">
                        <input type='hidden' id='submitted' name='submitted'>
                        <input type='hidden' id='cart_product' name='cart_product' value="<?php echo $product_row['id'] ?>">
                        <input type='number' id='cart_quantity' name='cart_quantity' required>
                        <button type="submit" class="cart_button">Dodaj u košaricu</button>
                    </form>
                </div>
            <?php
            }  
            ?>
    </div>
</body>

</html>