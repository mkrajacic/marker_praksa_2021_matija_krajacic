<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $query = "SELECT * FROM customer WHERE id=" . $customer_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Jeste li sigurni da želite obrisati kupca " . $row['name'] .  " ?</p>";
            echo "<a style='padding-right:5px' href='delete_customer.php?id=" . $customer_id . "'>Obriši</a>";
            echo "<a href='customers.php'>Povratak</a>";
        }
    }
} else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a style='padding-right:10px;' href='customers.php'>Povratak</a>";
    echo "<a href='index.php'>Povratak na početnu stranicu</a>";
}
include_once("footer.php");
?>