<?php
    include_once("header.php");
    include_once("functions.php");
    echo "<h1>Narudžbe</h1>";
    echo "<hr>";

        $table = "orders";
        $page = (empty($_GET['page'])) ? 1 : (int) $_GET['page'];
        $nmbrPage = getNmbrPage(getTotal($table,$connection),$limit);
        $offset = getOffset($limit,$page,$nmbrPage);
    include_once("queries.php");

    if($page_results) {
        while ($order_row = $page_results->fetch_assoc()) {

            if($order_products) {
                while ($ordered_row = $order_products->fetch_assoc()) {

                echo "<h4>Proizvod(i): ";
                echo "</h4>";
                    echo "<p>";
                        echo $ordered_row['products'];
                    echo "</p>";
                echo "<h4>Ukupno proizvoda: ";
                echo "</h4>";
                    echo "<p>";
                        echo $ordered_row['total_quantity'];
                    echo "</p>";
                echo "<h4>Ukupna cijena: ";
                echo "</h4>";
                    echo "<p>";
                        echo $ordered_row['total'];
                    echo "</p>";
                echo "<h5 style='display:inline-block; padding-right:5px;'>Ime kupca:</h5>";
                        echo $ordered_row['order_name'];
                echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Prezime kupca:</h5>";
                        echo $ordered_row['order_surname'];
                echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Adresa kupca:</h5>";
                        echo $ordered_row['order_address'];
                echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Email kupca:</h5>";
                        echo $ordered_row['order_email'];

                            echo "<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Status narudžbe:</h5>";
                            echo $ordered_row['order_status'];
                    
                    echo "<br><a style='padding-right:5px;'  href='delete_order_confirmation.php?id=" . $ordered_row['order_id'] . "'><button type='button' class='delete_button'>Obriši</button></a>";
                    echo "<a style='padding-right:5px;' href='edit_order.php?id=" . $ordered_row['order_id'] . "'><button type='button' class='edit_button'>Uredi</button></a><br>";
                    echo "<a style='padding-right:5px;' href='edit_order_products.php?id=" . $ordered_row['order_id'] . "'><button type='button' class='edit_button' style='width:120px; white-space:nowrap'>Uredi proizvode</button></a><br>";
                    echo "<hr>";
                }
            }
        }
    }

    $link = "orders";
    pagination_display($page,$link,$nmbrPage);

    echo "<h1>Nova narudžba</h1>";

    include_once("new_order.php");
    include_once("footer.php");
?>