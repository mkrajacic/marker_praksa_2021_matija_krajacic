<?php
echo "<form method='post' action='new_order_submit.php'>";
        echo "<input type='hidden' id='submitted' name='submitted'>";
        echo "<label for='name'>Ime kupca:</label><br>";
            echo "<input type='text' id='name' name='name' value='' required><br>";
        echo "<label for='name'>Prezime kupca:</label><br>";
            echo "<input type='text' id='surname' name='surname' value='' required><br>";
        echo "<label for='address'>Adresa kupca:</label><br>";
            echo "<input type='text' id='addrss' name='address' value='' required><br>";
        echo "<label for='email'>Email kupca:</label><br>";
            echo "<input type='email' id='email' name='email' value='' required><br>";
        echo "<label for='status'>Status narudžbe:</label><br>";
            echo "<select name='status' id='status'>";
            echo "<option value='0' selected>Odaberite status...</option>";
                        if($os) {
                            while($os_row = $os->fetch_assoc()) {
                                        echo "<option value=" .  $os_row['id'] . ">" . $os_row['status'] . "</option>";
                            }
                        }
            echo "</select><br>";
            echo "<br><input type='submit' value='Dodaj'>";
    echo "</form>";
?>