<?php
    $page = (empty($_GET['page'])) ? 1 : (int) $_GET['page'];
    $limit = 3;
    $query = "SELECT COUNT(*) FROM " . $table;
    $result = $connection->query($query);
    if ($result) {
        $row_result = $result->fetch_row();
        $total = $row_result[0];
    } else {
        echo "Nema rezultata!";
    }
    $nmbrPage = ceil($total / $limit);
    if ($page < 1) {
        $page = 1;
    } else if ($page > $nmbrPage - 1) {
        $page = $nmbrPage;
    }
    $offset = $limit * ($page - 1);
?>