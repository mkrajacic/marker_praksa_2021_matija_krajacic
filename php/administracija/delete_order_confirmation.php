<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $query = "SELECT * FROM orders WHERE id=" . $order_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Jeste li sigurni da želite obrisati narudžbu #" . $row['id'] .  " ?</p>";
            echo "<a style='padding-right:5px' href='delete_order.php?id=" . $order_id . "'>Obriši</a>";
            echo "<a href='orders.php'>Povratak</a>";
        }
    }
} else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a href='orders.php'>Povratak</a>";
}
include_once("footer.php");
?>