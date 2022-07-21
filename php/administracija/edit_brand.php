<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Uredi brend</h1>";

    if(isset($_GET['id'])) {
        $brand_id = $_GET['id'];

        if (isset($_POST['submitted'])) {
    
                include_once("brand_validation.php");

                if($pass == 1) {

                    $edit_brand = $connection->prepare("UPDATE brand SET name=?, description=?, active=? WHERE id=?");
                    $edit_brand->bind_param('ssii', $brand, $description, $active, $brand_id);

                    if ($edit_brand->execute()) {
                        echo "<p>Brend uspješno uređen!</p>";
                        echo "<a style='padding-right:10px;' href='brands.php'>Povratak</a>";
                        echo "<a href='index.php'>Povratak na početnu stranicu</a>";
                        echo "<br><hr><br>";
                    }
                    else {
                        echo "<p>Dogodila se pogreška! ";
                        printf($edit_brand->error);
                        echo "</p>";
                        echo "<a style='padding-right:10px;' href='brands.php'>Povratak</a>";
                        echo "<a href='index.php'>Povratak na početnu stranicu</a>";
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
        echo "<a href='index.php'>Povratak</a>";
    }

    $query = "SELECT * FROM brand WHERE id=" . $brand_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
echo "<form method='post' action=''>";
        echo "<input type='hidden' id='submitted' name='submitted'>";
    echo "<label for='brand'>Novi naziv brenda:</label><br>";
        echo "<input type='text' id='brand' name='brand' value='" . $row['name'] . "' required><br>";
    echo "<label for='description'>Opis kategorije:</label><br>";
        echo "<textarea style='height:100px' id='description' name='description' required>" . $row['description'] . "</textarea><br  >";
        if($row['active']==1) {
            echo "<input type='checkbox' name='active' id='active' value='1' checked>";
        }
        else {
            echo "<input type='checkbox' name='active' id='active' value='1'>";
        }
    echo "<label for='active'>Aktivan</label>";
        echo "<br><input type='submit' value='Dodaj'>";
echo "</form>";
        }
    }

include_once("footer.php");
?>