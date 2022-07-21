<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_POST['submitted'])) {

    include_once("category_validation.php");

    if($pass == 1) {

    $new_category = $connection->prepare("INSERT into category (name,description,active,main_id) VALUES (?,?,?,?)");
    $new_category->bind_param('ssii', $category, $description, $active, $main);
    if ($new_category->execute()) {
        echo "<p>Kategorija uspješno dodana!</p>";
        echo "<a href='index.php'>Povratak</a>";
    }
    else {
        echo "<p>Dogodila se pogreška! ";
        printf($new_category->error);
        echo "</p>";
        echo "<a href='index.php'>Povratak</a>";
    }
        }else{
            echo "<p class='error'>";
            echo $error;
            echo "</p>";
            echo "<hr><br>";
        }
}
include_once("footer.php");
?>