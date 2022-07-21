<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $brand_id = $_GET['id'];
    $query = "DELETE FROM brand WHERE id = ?";
    $prepare = $connection->prepare($query);
    $prepare->bind_param('i',$brand_id);

    if ($prepare->execute()) {
        echo "<p>Brend uspješno obrisan!</p>";
        echo "<a style='padding-right:10px;' href='brands.php'>Povratak</a>";
        echo "<a href='index.php'>Povratak na početnu stranicu</a>";
    }
} else {
    echo "<p>Dogodila se pogreška! " . mysqli_error($connection) . "</p>";
    echo "<a style='padding-right:10px;' href='brands.php'>Povratak</a>";
    echo "<a href='index.php'>Povratak na početnu stranicu</a>";
}
include_once("footer.php");
?>