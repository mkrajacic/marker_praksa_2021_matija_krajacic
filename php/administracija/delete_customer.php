<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $query = "DELETE FROM customer WHERE id = ?";
    $prepare = $connection->prepare($query);
    $prepare->bind_param('i',$customer_id);

    if ($prepare->execute()) {
        echo "<p>Kupac uspješno obrisan!</p>";
        echo "<a style='padding-right:10px;' href='customers.php'>Povratak</a>";
        echo "<a href='index.php'>Povratak na početnu stranicu</a>";
    }
} else {
    echo "<p>Dogodila se pogreška! " . mysqli_error($connection) . "</p>";
    echo "<a style='padding-right:10px;' href='customers.php'>Povratak</a>";
    echo "<a href='index.php'>Povratak na početnu stranicu</a>";
}
include_once("footer.php");
?>