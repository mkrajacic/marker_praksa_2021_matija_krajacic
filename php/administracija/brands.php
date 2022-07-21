<?php
    include_once("header.php");
    include_once("functions.php");
    echo "<h1>Brendovi</h1>";
    echo "<hr>";

    $table = "brand";
    $column = "name";
    $file = "brands";
    $title = "Pretraga brendova po imenu";
    $label = "Ime brenda:";
    search_bar($title,$label,$table,$column,$file);
    echo "<hr>";

            $table = "brand";
            $page = (empty($_GET['page'])) ? 1 : (int) $_GET['page'];
            $nmbrPage = getNmbrPage(getTotal($table,$connection),$limit);
            $offset = getOffset($limit,$page,$nmbrPage);

    include_once("queries.php");

    if($page_results) {
        while($row = $page_results->fetch_assoc()) {
            echo "<h3 style='display:inline-block; padding-right:10px;'>";
            echo $row['name'];
            echo "</h3>";
            echo "<a style='padding-right:5px;'  href='delete_brand_confirmation.php?id=" . $row['id'] . "'><button type='button' class='delete_button'>Obriši</button></a>";
            echo "<a href='edit_brand.php?id=" . $row['id'] . "'><button type='button' class='edit_button'>Uredi</button></a>";
            echo "<p style='width:60%'>";
            echo $row['description'];
            echo "</p>";
            echo "<hr>";
        }
    }

            $link = "brands";
            pagination_display($page,$link,$nmbrPage);

    echo "<hr>";
    echo "<br>";
    echo "<h1>Novi brend</h1>";

    include_once("new_brand.php");
    include_once("footer.php");
?>