<?php
echo "<form method='post' action='new_brand_submit.php'>";
            echo "<input type='hidden' id='submitted' name='submitted'>";
        echo "<label for='category'>Novi brend:</label><br>";
            echo "<input type='text' id='brand' name='brand' required><br>";
        echo "<label for='description'>Opis brenda:</label><br>";
            echo "<textarea style='height:100px' id='description' name='description' required></textarea><br>";
            echo "<input type='checkbox' name='active' id='active' value='1' checked>";
        echo "<label for='active'>Aktivan</label><br>";
            echo "<input type='submit' value='Dodaj'>";
echo "</form>";
?>