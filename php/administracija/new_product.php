<?php
echo "<form method='post' action='new_product_submit.php'>";
        echo "<input type='hidden' id='submitted' name='submitted'>";
    echo "<label for='product'>Novi proizvod:</label><br>";
        echo "<input type='text' id='product' name='product' required><br>";
    echo "<label for='product_category'>Kategorija:</label><br>";
        echo "<select name='product_category' id='product_category'>";
        echo "<option value=0>Odaberite kategoriju...</option>";
                    if($category) {
                        while($product_category = $category->fetch_assoc()) {
                                echo "<option value=" .  $product_category['id'] . ">" . $product_category['name'] . "</option>";
                        }
                    }
        echo "</select><br><br>";
    echo "<label for='product_description'>Opis proizvoda:</label><br>";
        echo "<textarea style='height:100px' id='product_description' name='product_description' required></textarea><br>";
    echo "<label for='brand'>Brend:</label><br>";
        echo "<select name='brand_select' id='brand_select'>";
        echo "<option value=0>Odaberite brend...</option>";
                    if($brand_select) {
                        while($brand_row = $brand_select->fetch_assoc()) {
                                echo "<option value=" .  $brand_row['id'] . ">" . $brand_row['name'] . "</option>";
                        }
                    }
        echo "</select><br><br>";
    echo "<label for='price_base'>Osnovna cijena:</label><br>";
        echo "<input type='number' id='price_base' name='price_base' step='0.01' required><br>";
    echo "<label for='discount'>Popust:</label><br>";
        echo "<input type='number' id='discount' name='discount' step='0.01'><br>";
    echo "<label for='price_final'>Finalna cijena:</label><br>";
        echo "<input type='number' id='price_final' name='price_final' step='0.01' required><br>";
    echo "<label for='available'>Dostupna količina:</label><br>";
        echo "<input type='number' id='available' name='available' required><br>";
        echo "<input type='checkbox' name='active_product' id='active_product' value='1' checked>";
    echo "<label for='active_product'>Aktivno</label>";
        echo "<input type='checkbox' name='forbidden' id='forbidden' value='1>";
    echo "<label for='forbidden'>Zabranjeno</label><br>";
        echo "<input type='checkbox' name='special' id='special' value='1'>";
    echo "<label for='special'>Izdvojeno</label><br>";
        echo "<input type='submit' value='Dodaj'>";
echo "</form>";

?>