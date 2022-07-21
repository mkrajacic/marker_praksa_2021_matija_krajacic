<?php
echo "<form method='post' action='new_customer_submit.php'>";
            echo "<input type='hidden' id='submitted' name='submitted'>";
        echo "<label for='name'>Ime:</label><br>";
            echo "<input type='text' id='name' name='name' required><br>";
        echo "<label for='surname'>Prezime:</label><br>";
            echo "<input type='text' id='surname' name='surname' required><br>";
        echo "<label for='name'>Email:</label><br>";
            echo "<input type='email' id='email' name='email' required><br>";
        echo "<label for='name'>Lozinka:</label><br>";
            echo "<input type='password' id='password' name='password' required><br>";
            echo "<input type='submit' value='Dodaj'>";
echo "</form>";
?>