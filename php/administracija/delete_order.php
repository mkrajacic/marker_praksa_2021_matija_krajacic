<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $query = "DELETE FROM orders WHERE id = ?";
    $prepare = $connection->prepare($query);
    $prepare->bind_param('i',$order_id);

    if ($prepare->execute()) {
        echo "<p>Narudžba uspješno obrisana!</p>";
        echo "<a href='orders.php'>Povratak</a>";
    }
} else {
    echo "<p>Dogodila se pogreška! " . mysqli_error($connection) . "</p>";
    echo "<a href='orders.php'>Povratak</a>";
}
include_once("footer.php");
?>