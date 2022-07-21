<?php
        if ($nmbrPage > 1) {

            echo "<ul class='pagination'>";
    
            if ($page > 1) {
                echo "<li><a class='page-link' href='" . $link . ".php?page=" . ($page - 1) . "' >
                ⮜ Prethodna </a></li>";
            }
            for ($i = 1; $i <= $nmbrPage; $i++) {
                if ($i == $page) {
                    echo "<li class='page-item'><span class='page-link'> $i </span></li>";
                } else {
                    echo "<li><a class='page-link' href='" . $link . ".php?page=$i'> $i </a></li>";
                }
            }
            if ($page < $nmbrPage) {
                echo "<li><a class='page-link' href='" . $link . ".php?page=" . ($page + 1) . "' >
                            Sljedeća ⮞ </a></li>";
            }
            
            echo "</ul>";
        }
?>  