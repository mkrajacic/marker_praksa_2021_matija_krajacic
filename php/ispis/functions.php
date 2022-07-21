<?php
include_once("connection.php");
?>
<?php
$limit = 2;

function getTotal($table, $connection)
{
    $query = "SELECT COUNT(*) FROM " . $table;
    $result = $connection->query($query);
    if ($result) {
        $row_result = $result->fetch_row();
        $total = $row_result[0];
    } else {
        $total = 0;
    }

    return $total;
}

function getNmbrPage($total, $limit)
{
    return $nmbrPage = ceil($total / $limit);
}

function getOffset($limit, $page, $nmbrPage)
{
    if ($page < 1) {
        $page = 1;
    } else if ($page > $nmbrPage - 1) {
        $page = $nmbrPage;
    }
    return $offset = $limit * ($page - 1);
}

?>
<?php
function pagination_display($page, $nmbrPage)
{
    if ($nmbrPage > 1) { ?>

        <ul class='pagination'>
            <?php if ($page > 1) { ?>
                <li><a class='page-link' href='<?php echo basename($_SERVER['REQUEST_URI']) ?>&page=<?php echo ($page - 1) ?>'><button type='button' class='navigation_button'>⮜ Prethodna </button></a></li>
                <?php               }
            for ($i = 1; $i <= $nmbrPage; $i++) {
                if ($i == $page) {
                ?>
                    <li class='page-item'><span class='page-link'><?php echo $i ?></span></li>
                <?php              } else {

                ?>
                    <li><a class='page-link' href='<?php echo basename($_SERVER['REQUEST_URI']) ?>&page=<?php echo $i ?>'><?php echo $i ?></a></li>
                <?php
                }
            }
            if ($page < $nmbrPage) {
                ?>
                <li><a class='page-link' href='<?php echo basename($_SERVER['REQUEST_URI']) ?>&page=<?php echo ($page + 1) ?>'><button type='button' class='navigation_button'>Sljedeća ⮞ </button></a></li>
            <?php
            }
            ?>
        </ul>
<?php
    }
}
?>
<?php

function getJoinResults($join, $connection)
{
    return $join_results = $connection->query($join, MYSQLI_STORE_RESULT);
}
function executeQuery($column, $table, $condition, $orderBy, $connection)
{
    if ($condition == null) {
        $ns_page_query = "SELECT " . $column . " FROM " .  $table . " ORDER BY " . $orderBy;
    } else {
        $ns_page_query = "SELECT " . $column . " FROM " .  $table . " WHERE " . $condition . " ORDER BY " . $orderBy;
    }
    return $ns_page_results = $connection->query($ns_page_query, MYSQLI_STORE_RESULT);
}

function validate($fields)
{

    $errors = array();

    foreach ($fields as $field) {

        if (!function_exists('str_contains')) {
            if (strpos($field, "email") !== false) {
                if (!filter_var(trim(($_POST["$field"])), FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Neispravna email adresa! - " . $field);
                }
            }

            if (strpos($field, "cart_quantity") !== false) {
                if (htmlentities(trim((int)$_POST["$field"])) < 0)
                    array_push($errors, "Neispravna upisana količina! - " . $field);
            }
        } else {
            if (str_contains($field, "email")) {
                if (!filter_var(trim(($_POST["$field"])), FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Neispravna email adresa! - " . $field);
                }
            }

            if (str_contains($field, "cart_quantity")) {
                if (htmlentities(trim((int)$_POST["$field"])) < 0)
                    array_push($errors, "Neispravna upisana količina! - " . $field);
            }
        }

        // $functions = array('!isset','empty','ctype_space');

        // foreach($functions as $fun) {

        //     if($fun($_POST["$field"])) {
        //         array_push($errors, "Ovo polje je obavezno! - " . $field);
        //     }

        // }

        if (!isset($_POST["$field"])) {
            array_push($errors, "Ovo polje je obavezno! - " . $field);
        }

        if (empty($_POST["$field"])) {
            array_push($errors, "Ovo polje je obavezno! - " . $field);
        }

        if (ctype_space($_POST["$field"])) {
            array_push($errors, "Ovo polje je obavezno! - " . $field);
        }
    }

    return $errors;
}

function setOrderBy($sortBy)
{

    switch ($sortBy) {
        case "newest":
            $orderBy = "product.id DESC";
            break;
        case "oldest":
            $orderBy = "product.id ASC";
            break;
        case "cheapest":
            $orderBy = "product.price_final ASC";
            break;
        case "expensive":
            $orderBy = "product.price_final DESC";
            break;
    }

    return $orderBy;
}

function generateMessage($getFields)
{
    foreach ($getFields as $get) {

        if (isset($_GET["$get"])) {
            if ($get == "deleted") {
                if ($_GET['deleted'] == 1) {
                    echo "<div class='cart_success'>";
                    echo "<p class='no-results'>Proizvod uspješno obrisan iz košarice! ";
                    echo "</div>";
                } else if ($_GET['deleted'] == 2) {
                    echo "<div class='cart_failure'>";
                    echo "<p class='no-results'>Dogodila se pogreška pri brisanju proizvoda iz košarice!";
                    echo "</p>";
                    echo "</div>";
                }
            }

            if ($get == "updated") {
                if ($_GET['updated'] == 1) {
                    echo "<div class='cart_success'>";
                    echo "<p class='no-results'>Količina uspješno uređena! ";
                    echo "</div>";
                } else if ($_GET['updated'] == 2) {
                    echo "<div class='cart_failure'>";
                    echo "<p class='no-results'>Dogodila se pogreška pri uređivanju količine proizvoda!";
                    echo "</p>";
                    echo "</div>";
                }
            }
        }
    }
}

function throwError() {
    echo "<div class='cart_failure'>";
    echo "<p class='no-results'>Greška!</p>";
    echo "</div>";
}

?>