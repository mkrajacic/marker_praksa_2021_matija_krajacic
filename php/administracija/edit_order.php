<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Uredi narudžbu</h1>";

    if(isset($_GET['id'])) {
        $order_id = $_GET['id'];

        if (isset($_POST['submitted'])) {
            include_once("order_validation.php");

            if($pass == 1) {
                $edit_order = $connection->prepare("UPDATE orders SET name=?, surname=?, address=?, email=?, status=? WHERE id=?");
                $edit_order->bind_param('ssssii', $name, $surname, $address, $email, $status,$order_id);

                if ($edit_order->execute()) {
                    echo "<p>Narudžba uspješno uređena!</p>";
                    echo "<a href='orders.php'>Povratak</a>";
                    echo "<br><hr><br>";
                 }else {
                    echo "<p>Dogodila se pogreška! ";
                    printf($edit_order->error);
                    echo "</p>";
                    echo "<a href='orders.php'>Povratak</a>";
                    echo "<br><hr><br>";
                 }
                }
        }

        $os_query = "SELECT * FROM order_status ORDER BY id";
        $os = $connection->query($os_query, MYSQLI_STORE_RESULT);

        $query = "SELECT * FROM orders WHERE id=" . $order_id;
        $result = $connection->query($query, MYSQLI_STORE_RESULT);
        
    if ($result) {
        while ($row = $result->fetch_assoc()) {
echo "<form method='post' action=''>";
        echo "<input type='hidden' id='submitted' name='submitted'>";
    echo "<label for='name'>Ime kupca:</label><br>";
        echo "<input type='text' id='name' name='name' value='" . $row['name'] . "' required><br>";
    echo "<label for='name'>Prezime kupca:</label><br>";
        echo "<input type='text' id='surname' name='surname' value='" . $row['surname'] . "' required><br>";
    echo "<label for='address'>Adresa kupca:</label><br>";
        echo "<input type='text' id='addrss' name='address' value='" . $row['address'] . "' required><br>";
    echo "<label for='email'>Email kupca:</label><br>";
        echo "<input type='email' id='email' name='email' value='" . $row['email'] . "' required><br>";
    echo "<label for='status'>Status narudžbe:</label><br>";
        echo "<select name='status' id='status'>";
        echo "<option value=0>Odaberite status...</option>";
                    if($os) {
                        while($os_row = $os->fetch_assoc()) {
                                if($os_row['id'] == $row['status']) {
                                    echo "<option value=" .  $os_row['id'] . " selected>" . $os_row['status'] . "</option>";
                                }else {
                                    echo "<option value=" .  $os_row['id'] . ">" . $os_row['status'] . "</option>";
                                }
                        }
                    }
        echo "</select><br>";
        echo "<br><input type='submit' value='Uredi'>";
echo "</form>";
        }
    }
}else {
    echo "<p>Dogodila se pogreška!</p>";
    echo "<a href='orders.php'>Povratak</a>";
}

include_once("footer.php");
?>