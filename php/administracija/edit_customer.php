<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Uredi kupca</h1>";

    if(isset($_GET['id'])) {
        $customer_id = $_GET['id'];

        if (isset($_POST['submitted'])) {
    
                include_once("customer_validation.php");

            if($pass == 1) {
            
                $edit_customer = $connection->prepare("UPDATE customer SET email=?, password=?, name=?, surname=? WHERE id=?");
                $edit_customer->bind_param('ssssi', $email, $password_encrypted, $name, $surname, $customer_id);
                if ($edit_customer->execute()) {
                    echo "<p>Kupac uspješno uređen!</p>";
                    echo "<a href='customers.php'>Povratak</a>";
                    echo "<br><hr><br>";
                }
                else {
                    echo "<p>Dogodila se pogreška! ";
                    printf($edit_customer->error);
                    echo "</p>";
                    echo "<a href='customers.php'>Povratak</a>";
                    echo "<br><hr><br>";
                }
        }else {
            echo "<p class='error'>";
            echo $error;
            echo "</p>";
            echo "<hr><br>";
        }

     }
    }
    else {
        echo "<p>Dogodila se pogreška!</p>";
        echo "<a href='customers.php'>Povratak</a>";
    }

    $query = "SELECT * FROM customer WHERE id=" . $customer_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
echo "<form method='post' action=''>";
            echo "<input type='hidden' id='submitted' name='submitted'>";
        echo "<label for='name'>Ime:</label><br>";
            echo "<input type='text' id='name' name='name' value='" . $row['name'] . "' required><br>";
        echo "<label for='surname'>Prezime:</label><br>";
            echo "<input type='text' id='surname' name='surname' value='" . $row['surname'] . "' required><br>";
        echo "<label for='name'>Email:</label><br>";
            echo "<input type='email' id='email' name='email' value='" . $row['email'] . "' required><br>";
        echo "<label for='name'>Lozinka:</label><br>";
            echo "<input type='password' id='password' name='password' required><br>";
        echo "<input type='submit' value='Uredi'>";
echo "</form>";
        }
    }

include_once("footer.php");
?>