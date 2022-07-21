<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $query = "SELECT * FROM category WHERE id=" . $category_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Jeste li sigurni da želite obrisati kategoriju " . $row['name'] .  " ?</p>";
            echo "<a style='padding-right:5px' href='delete_category.php?id=" . $category_id . "'>Obriši</a>";
            echo "<a href='index.php'>Povratak</a>";
        }
    }
} else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a href='index.php'>Povratak</a>";
}
include_once("footer.php");
?>