<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");

if (isset($_POST['submitted'])) {

    include_once("order_validation.php");

            if($pass == 1) {
                    $new_order = $connection->prepare("INSERT into orders (name,surname,address,email,status) VALUES (?,?,?,?,?)");
                    $new_order->bind_param('ssssi', $name, $surname, $address, $email, $status);

                    if ($new_order->execute()) {
                        $order_id = mysqli_insert_id($connection);
                        header("Location: new_order_products.php?id=" . $order_id);
                        echo "<br><hr><br>";
                    }else {
                        echo "<p>Dogodila se pogreška! ";
                        printf($new_order->error);
                        echo "</p>";
                        echo "<a href='orders.php'>Povratak</a>";
                        echo "<br><hr><br>";
                    }
            }else{
                echo "<p class='error'>";
                echo $error;
                echo "</p>";
                echo "<hr><br>";
                echo "<a href='orders.php'>Povratak</a>";
            }
        }

        include_once("footer.php");
?>