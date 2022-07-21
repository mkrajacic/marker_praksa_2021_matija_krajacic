<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_POST['submitted'])) {

    include_once("brand_validation.php");

    if($pass == 1) {

    $new_brand = $connection->prepare("INSERT into brand (name,description,active) VALUES (?,?,?)");
    $new_brand->bind_param('ssi', $brand, $description, $active);
    if ($new_brand->execute()) {
        echo "<p>Brend uspješno dodan!</p>";
        echo "<a href='brands.php'>Povratak</a>";
    }
    else {
        echo "<p>Dogodila se pogreška! ";
        printf($new_brand->error);
        echo "</p>";
        echo "<a href='brands.php'>Povratak</a>";
    }
            }else {
                echo "<p class='error'>";
                echo $error;
                echo "</p>";
                echo "<hr><br>";
            }
}
include_once("footer.php");
?>