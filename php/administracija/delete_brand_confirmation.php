<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $brand_id = $_GET['id'];
    $query = "SELECT * FROM brand WHERE id=" . $brand_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Jeste li sigurni da želite obrisati brend " . $row['name'] .  " ?</p>";
            echo "<a style='padding-right:5px' href='delete_brand.php?id=" . $brand_id . "'>Obriši</a>";
            echo "<a href='brands.php'>Povratak</a>";
        }
    }
} else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a style='padding-right:10px;' href='brands.php'>Povratak</a>";
    echo "<a href='index.php'>Povratak na početnu stranicu</a>";
}
include_once("footer.php");
?>