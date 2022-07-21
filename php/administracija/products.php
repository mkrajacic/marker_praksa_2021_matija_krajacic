<?php
    include_once("header.php");
    include_once("functions.php");
    echo "<h1>Proizvodi</h1>";
    echo "<hr>";

    $table = "product";
    $column = "name";
    $file = "products";
    $title = "Pretraga proizvoda po imenu";
    $label = "Ime proizvoda:";
    search_bar($title,$label,$table,$column,$file);
    echo "<hr>";

        $table = "product";
        $page = (empty($_GET['page'])) ? 1 : (int) $_GET['page'];
        $nmbrPage = getNmbrPage(getTotal($table,$connection),$limit);
        $offset = getOffset($limit,$page,$nmbrPage);
    include_once("queries.php");

    if($page_results) {
        while ($product_row = $page_results->fetch_assoc()) {
            echo "<h3 style='display:inline-block; padding-right:10px;'>";
            echo $product_row['name'];
            echo "</h3>";
            echo "<a style='padding-right:5px;'  href='delete_product_confirmation.php?id=" . $product_row['id'] . "'><button type='button' class='delete_button'>Obriši</button></a>";
            echo "<a href='edit_product.php?id=" . $product_row['id'] . "'><button type='button' class='edit_button'>Uredi</button></a>";
            echo "<p>";
            echo $product_row['description'];
            echo "</p>";
            echo "<h5 style='display:inline-block; padding-right:5px;'>Osnovna cijena:</h5>";
            echo $product_row['price_base'] . "kn";
            echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Popust:</h5>";
            echo $product_row['discount'] . "%";
            echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Finalna cijena:</h5>";
            echo $product_row['price_final']. "kn";
            echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Dostupno:</h5>";
            echo $product_row['available'];
            echo "<br>";
            echo "<hr>";
        }
    }

    $link = "products";
    pagination_display($page,$link,$nmbrPage);

    echo "<h1>Novi proizvod</h1>";
    include_once("new_product.php");
    include_once("footer.php");
?>