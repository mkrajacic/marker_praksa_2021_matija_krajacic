<?php
    include_once("header.php");
    include_once("functions.php");
    echo "<h1>Kupci</h1>";
    echo "<hr>";

    $table = "customer";
    $column = "name";
    $file = "customers";
    $title = "Pretraga kupaca po imenu";
    $label = "Ime kupca:";
    search_bar($title,$label,$table,$column,$file);
    echo "<hr>";

        $table = "customer";
        $page = (empty($_GET['page'])) ? 1 : (int) $_GET['page'];
        $nmbrPage = getNmbrPage(getTotal($table,$connection),$limit);
        $offset = getOffset($limit,$page,$nmbrPage);
    include_once("queries.php");

    if($page_results) {
        while ($product_row = $page_results->fetch_assoc()) {
            echo "<h3 style='display:inline-block; padding-right:10px;'>";
            echo $product_row['name'] . " " . $product_row['surname'];
            echo "</h3>";
            echo "<a style='padding-right:5px;'  href='delete_customer_confirmation.php?id=" . $product_row['id'] . "'><button type='button' class='delete_button'>Obriši</button></a>";
            echo "<a href='edit_customer.php?id=" . $product_row['id'] . "'><button type='button' class='edit_button'>Uredi</button></a>";
            echo "<p>";
            echo $product_row['email'];
            echo "</p>";
            echo "<br>";
            echo "<hr>";
        }
    }

    $link = "customers";
    pagination_display($page,$link,$nmbrPage);

    echo "<h1>Novi kupac</h1>";
    include_once("new_customer.php");
    include_once("footer.php");
?>