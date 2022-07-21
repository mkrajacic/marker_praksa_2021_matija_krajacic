<?php
include_once("connection.php");
?>
<?php
function search_bar($title,$label,$table,$column,$file) {
?>
    <h1><?php echo $title ?></h1>
    <form method='post' action='search_results.php'>
        <label for='search'><?php echo $label ?></label><br>
            <input type='hidden' id='submitted' name='submitted'>
            <input type='hidden' id='table' name='table' value='<?php echo $table ?>'>
            <input type='hidden' id='column' name='column' value='<?php echo $column ?>'>
            <input type='hidden' id='file' name='file' value='<?php echo $file ?>'>
            <input type='text' id='search' name='search' required><br>
            <input type='submit' value='Traži'>
    </form>
<?php } ?>

<?php
    function search_results($connection,$term,$table,$column,$file) {
        $query = "SELECT * FROM " . $table . " WHERE " . $column . " LIKE '" . $term . "%'";
        $result = $connection->query($query, MYSQLI_STORE_RESULT);
        if (mysqli_num_rows($result)>0) {
            while ($result_row = $result->fetch_assoc()) {

                if($table == "product") {
?>
<h3 style='display:inline-block; padding-right:10px;'>
    <?php echo $result_row['name'] ?>
</h3>
<p>
    <?php echo $result_row['description'] ?>
</p>
<h5 style='display:inline-block; padding-right:5px;'>Osnovna cijena:</h5>
    <?php echo $result_row['price_base'] ?>.kn
<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Popust:</h5>
    <?php echo $result_row['discount'] ?>.%
<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Finalna cijena:</h5>
    <?php echo $result_row['price_final'] ?>.kn
<h5 style='display:inline-block; padding-right:5px; padding-left:5px;'>Dostupno:</h5>
    <?php echo $result_row['available'] ?>.%
<br>

 <?php 
                }else if($table == "brand") { ?>

<h3 style='display:inline-block; padding-right:10px;'>
    <?php echo $result_row['name'] ?>
</h3>
<p>
    <?php echo $result_row['description'] ?>
</p>
<br>
            
    <?php            
    }else if($table == "customer") { ?>

     <h3 style='display:inline-block; padding-right:10px;'>
    <?php echo $result_row['name'] ?>
    <?php echo $result_row['surname'] ?>
</h3>
<p>
    <?php echo $result_row['email'] ?>
</p>
<br> 
        
        
  <?php  }          
        }
        }else { ?>
<p>Nema pronađenih rezultata!</p>
  
  <?php     
   }   
    ?>
   <br><a href='<?php echo $file ?>.php'>Povratak</a>
 <?php  
  }
?>

<?php

 $limit = 3;

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

function getNmbrPage($total,$limit) {
    return $nmbrPage = ceil($total / $limit);
}

function getOffset($limit,$page,$nmbrPage) {
    if ($page < 1) {
        $page = 1;
    } else if ($page > $nmbrPage - 1) {
        $page = $nmbrPage;
    }
    return $offset = $limit * ($page - 1);
}

?>
<?php
function pagination_display($page, $link, $nmbrPage)
{
    if ($nmbrPage > 1) { ?>

        <ul class='pagination'>
            <?php if ($page > 1) { ?>
                <li><a class='page-link' href='<?php echo $link ?>.php?page=<?php echo ($page - 1) ?>'><button type='button' class='navigation_button'>⮜ Prethodna </button></a></li>
                <?php               }
            for ($i = 1; $i <= $nmbrPage; $i++) {
                if ($i == $page) {
                ?>
                    <li class='page-item'><span class='page-link'><?php echo $i ?></span></li>
                <?php              } else {

                ?>
                    <li><a class='page-link' href='<?php echo $link ?>.php?page=<?php echo $i ?>'><?php echo $i ?></a></li>
                <?php
                }
            }
            if ($page < $nmbrPage) {
                ?>
                <li><a class='page-link' href='<?php echo $link ?>.php?page=<?php echo ($page + 1) ?>'><button type='button' class='navigation_button'>Sljedeća ⮞ </button></a></li>
            <?php
            }
            ?>
        </ul>
<?php
    }
}
?>