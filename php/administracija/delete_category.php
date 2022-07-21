<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $query = "DELETE FROM category WHERE id = ?";
    $prepare = $connection->prepare($query);
    $prepare->bind_param('i',$category_id);

    if ($prepare->execute()) {
        echo "<p>Kategorija uspješno obrisana!</p>";
        echo "<a href='index.php'>Povratak</a>";
    }
} else {
    echo "<p>Dogodila se pogreška! " . mysqli_error($connection) . "</p>";
    echo "<a href='index.php'>Povratak</a>";
}
include_once("footer.php");
?>