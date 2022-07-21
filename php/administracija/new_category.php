<?php
echo "<form method='post' action='new_category_submit.php'>";
            echo "<input type='hidden' id='submitted' name='submitted'>";
        echo "<label for='category'>Nova kategorija:</label><br>";
            echo "<input type='text' id='category' name='category' required><br>";
        echo "<label for='description'>Opis kategorije:</label><br>";
            echo "<textarea style='height:100px' id='description' name='description' required></textarea><br>";
            echo "<input type='checkbox' name='active' id='active' value='1' checked>";
        echo "<label for='active'>Aktivna</label>";
            echo "<input type='checkbox' name='main' id='main' value='0' checked>";
        echo "<label for='main'>Glavna</label><br>";
            echo "<input type='submit' value='Dodaj'>";
echo "</form>";
?>