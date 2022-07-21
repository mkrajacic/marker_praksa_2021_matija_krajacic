<?php
    include_once("header.php");
    include_once("functions.php");
    echo "<h1>Kategorije</h1>";
    echo "<hr><br>";
    
        $table = "category";
        $page = (empty($_GET['page'])) ? 1 : (int) $_GET['page'];
        $nmbrPage = getNmbrPage(getTotal($table,$connection),$limit);
        $offset = getOffset($limit,$page,$nmbrPage);
    include_once("queries.php");

        if($page_results) {
            while($row = $page_results->fetch_assoc()) {
                echo "<h3 style='display:inline-block; padding-right:10px;'>";
                echo "<a style='text-decoration:none;' href='category_products.php?id=" . $row['id'] . "'>";
                echo $row['name'];
                echo "</a></h3>";
                echo "<a style='padding-right:5px;'  href='delete_category_confirmation.php?id=" . $row['id'] . "'><button type='button' class='delete_button'>Obriši</button></a>";
                echo "<a href='edit_category.php?id=" . $row['id'] . "'><button type='button' class='edit_button'>Uredi</button></a>";
                echo "<p style='width:60%'>";
                echo $row['description'];
                echo "</p>";
                echo "<hr>";
            }
        }

        $link = "index";
        pagination_display($page,$link,$nmbrPage);
        
        echo "<br>";
        echo "<h1>Nova kategorija</h1>";
        include_once("new_category.php");

        include_once("footer.php");
?>