<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Uređivanje proizvoda</h1>";

    if(isset($_GET['id'])) {
        $product_id = $_GET['id'];

        if (isset($_POST['submitted'])) {

            include_once("product_validation.php");

            if($pass == 1) {

            $edit_product = $connection->prepare("UPDATE product SET name=?, brand_id=?, description=?, price_base=?, discount=?, price_final=?, available=?, forbidden=?, special=?, active=? WHERE id=?");
            $edit_product->bind_param('sisdidiiiii', $name,$brand_id,$product_description,$price_base,$discount,$price_final,$available,$forbidden,$special,$active,$product_id);
            if ($edit_product->execute()) {
        
                $edit_product_category = $connection->prepare("UPDATE product_category SET category_id=? WHERE product_id=?");
                $edit_product_category->bind_param('ii',$product_category,$product_id);
                    if ($edit_product_category->execute()) {

                        if(!isset($_GET['id'])) {
                            echo "<p>Proizvod uspješno uređen!</p>";
                            echo "<a href='products.php'>Povratak</a>";
                            echo "<br><hr><br>";
                        }else {
                            echo "<p>Proizvod uspješno uređen!</p>";
                            echo "<a href='category_products.php?id=" . $_GET['cid'] . "'>Povratak</a>";
                            echo "<br><hr><br>";
                        }

                    }
                    else {

                        if(!isset($_GET['id'])) {
                            echo "<p>Dogodila se pogreška! ";
                            echo "<a href='products.php'>Povratak</a>";
                            echo "<br><hr><br>";
                        }else {
                            echo "<p>Dogodila se pogreška! ";
                            printf($edit_product_category->error);
                            echo "</p>";
                            echo "<a href='category_products.php?id=" . $_GET['cid'] . "'>Povratak</a>";
                            echo "<br><hr><br>";
                        }

                    }
            }
            else {

                if(!isset($_GET['id'])) {
                    echo "<p>Dogodila se pogreška! ";
                    echo "<a href='products.php'>Povratak</a>";
                    echo "<br><hr><br>";
                }else {
                    echo "<p>Dogodila se pogreška! ";
                    printf($edit_product->error);
                    echo "</p>";
                    echo "<a href='category_products.php?id=" . $_GET['cid'] . "'>Povratak</a>";
                    echo "<br><hr><br>";
                }

            }
        }else {
            echo "<p class='error'>";
            echo $error;
            echo "</p>";
            echo "<hr><br>";
        }

        }
    }else {

        if(!isset($_GET['id'])) {
            echo "<p>Dogodila se pogreška! ";
            echo "<a href='products.php'>Povratak</a>";
            echo "<br><hr><br>";
        }else {
            echo "<p>Dogodila se pogreška!</p>";
            echo "<a href='category_products.php?id=" . $_GET['cid'] . "'>Povratak</a>";
            echo "<br><hr><br>";
        }

    }


    $equery = "SELECT * FROM product WHERE id=" . $product_id;
    $edit_query = $connection->query($equery, MYSQLI_STORE_RESULT);
    
    $brand_query = "SELECT * FROM brand ORDER BY id";
    $brand_select = $connection->query($brand_query, MYSQLI_STORE_RESULT);

    $category_query = "SELECT * FROM category ORDER BY id";
    $category = $connection->query($category_query, MYSQLI_STORE_RESULT);

    if ($edit_query) {
        while ($row = $edit_query->fetch_assoc()) {

        echo "<form method='post' action=''>";
        echo "<input type='hidden' id='submitted' name='submitted'>";
    echo "<label for='product'>Novi naziv:</label><br>";
        echo "<input type='text' id='product' name='product' value='" . $row['name'] . "' required><br>";
    echo "<label for='product_category'>Kategorija:</label><br>";
        echo "<select name='product_category' id='product_category'>";
        echo "<option value=0>Odaberite kategoriju...</option>";
                    if($category) {
                        while($product_category = $category->fetch_assoc()) {
                                if($product_category['id'] == $_GET['cid']) {
                                    echo "<option value=" .  $product_category['id'] . " selected>" . $product_category['name'] . "</option>";
                                }else {
                                    echo "<option value=" .  $product_category['id'] . ">" . $product_category['name'] . "</option>";
                                }
                        }
                    }
        echo "</select><br><br>";
    echo "<label for='product_description'>Opis proizvoda:</label><br>";
        echo "<textarea style='height:100px' id='product_description' name='product_description' required>" . $row['description'] . "</textarea><br>";
    echo "<label for='brand'>Brend:</label><br>";
        echo "<select name='brand_select' id='brand_select'>";
        echo "<option value=0>Odaberite brend...</option>";
                    if($brand_select) {
                        while($brand_row = $brand_select->fetch_assoc()) {
                            if($brand_row['id'] == $_GET['bid']) {
                                echo "<option value=" .  $brand_row['id'] . " selected>" . $brand_row['name'] . "</option>";
                            }else {
                                echo "<option value=" .  $brand_row['id'] . ">" . $brand_row['name'] . "</option>";
                            }
                        }
                    }
        echo "</select><br><br>";
    echo "<label for='price_base'>Osnovna cijena:</label><br>";
        echo "<input type='number' id='price_base' name='price_base' step='0.01' value='" . $row['price_base'] . "' required><br>";
    echo "<label for='discount'>Popust:</label><br>";
        echo "<input type='number' id='discount' name='discount' step='0.01' value='" . $row['discount'] . "'><br>";
    echo "<label for='price_final'>Finalna cijena:</label><br>";
        echo "<input type='number' id='price_final' name='price_final' step='0.01' value='" . $row['price_final'] . "' required><br>";
    echo "<label for='available'>Dostupna količina:</label><br>";
        echo "<input type='number' id='available' name='available' value='" . $row['discount'] . "' required><br>";
        if($row['active'] == 1) {
            echo "<input type='checkbox' name='active_product' id='active_product' value='1' checked>";
        }else {
            echo "<input type='checkbox' name='active_product' id='active_product' value='1'>";
        }
    echo "<label for='active_product'>Aktivno</label>";
        if($row['forbidden'] == 1) {
            echo "<input type='checkbox' name='forbidden' id='forbidden' value='1' checked>";
        }else {
            echo "<input type='checkbox' name='forbidden' id='forbidden' value='1'>";
        }
    echo "<label for='forbidden'>Zabranjeno</label><br>";
        if($row['special'] == 1) {
            echo "<input type='checkbox' name='special' id='special' value='1' checked>";
        }else {
            echo "<input type='checkbox' name='special' id='special' value='1'>";
        }
    echo "<label for='special'>Izdvojeno</label><br>";
        echo "<input type='submit' value='Uredi'>";
    echo "</form>";

                }
            }

include_once("footer.php");
?>