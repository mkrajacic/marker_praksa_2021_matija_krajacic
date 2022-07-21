<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_POST['submitted'])) {

    include_once("customer_validation.php");

    if($pass == 1) {

    $new_customer = $connection->prepare("INSERT into customer (email,password,name,surname) VALUES (?,?,?,?)");
    $new_customer->bind_param('ssss', $email, $password_encrypted, $name, $surname);
    if ($new_customer->execute()) {
        echo "<p>Kupac uspješno dodan!</p>";
        echo "<a href='customers.php'>Povratak</a>";
    }
    else {
        echo "<p>Dogodila se pogreška! ";
        printf($new_customer->error);
        echo "</p>";
        echo "<a href='customers.php'>Povratak</a>";
    }
        }else{
            echo "<p class='error'>";
            echo $error;
            echo "</p>";
            echo "<hr><br>";
            echo "<a href='customers.php'>Povratak</a>";
        }
}
include_once("footer.php");
?>