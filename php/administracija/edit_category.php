<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    echo "<h1>Uredi kategoriju</h1>";

    if(isset($_GET['id'])) {
        $category_id = $_GET['id'];

        if (isset($_POST['submitted'])) {
    
                include_once("category_validation.php");

            if($pass == 1) {
            
                $edit_category = $connection->prepare("UPDATE category SET name=?, description=?, active=?, main_id=? WHERE id=?");
                $edit_category->bind_param('ssiii', $category, $description, $active, $main, $category_id);
                if ($edit_category->execute()) {
                    echo "<p>Kategorija uspješno uređena!</p>";
                    echo "<a href='index.php'>Povratak</a>";
                    echo "<br><hr><br>";
                }
                else {
                    echo "<p>Dogodila se pogreška! ";
                    printf($edit_category->error);
                    echo "</p>";
                    echo "<a href='index.php'>Povratak</a>";
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

    $query = "SELECT * FROM category WHERE id=" . $category_id;
    $result = $connection->query($query, MYSQLI_STORE_RESULT);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
echo "<form method='post' action=''>";
        echo "<input type='hidden' id='submitted' name='submitted'>";
    echo "<label for='category'>Novi naziv kategorije:</label><br>";
        echo "<input type='text' id='category' name='category' value='" . $row['name'] . "' required><br>";
    echo "<label for='description'>Opis kategorije:</label><br>";
        echo "<textarea style='height:100px' id='description' name='description' required>" . $row['description'] . "</textarea><br  >";
        if($row['active']==1) {
            echo "<input type='checkbox' name='active' id='active' value='1' checked>";
        }
        else {
            echo "<input type='checkbox' name='active' id='active' value='1'>";
        }
    echo "<label for='active'>Aktivna</label>";
        if($row['main_id']==0) {
            echo "<input type='checkbox' name='main' id='main' value='0' checked>";
        }
        else {
            echo "<input type='checkbox' name='main' id='main' value='0'>";
        }
    echo "<label for='main'>Glavna</label><br>";
        echo "<input type='submit' value='Uredi'>";
echo "</form>";
        }
    }

include_once("footer.php");
?>