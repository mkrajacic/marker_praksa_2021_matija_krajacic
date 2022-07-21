<?php
    include_once("connection.php");
?>
<?php
    include_once("header.php");
    include_once("functions.php");
    echo "<h1>Rezultati pretrage:</h1>";

    if (isset($_POST['submitted'])) {
        if (!isset($_POST['search'])) {
            echo "<p>Niste upisali pojam pretrage!</p>";
            echo "<a href='index.php'>Povratak</a>";
        } else {
            $term = htmlentities($_POST['search']);
        }
        if (!isset($_POST['table'])) {
            echo "<p>Dogodila se pogreška!</p>";
            echo "<a href='index.php'>Povratak</a>";
        } else {
            $table = htmlentities($_POST['table']);
        }
        if (!isset($_POST['column'])) {
            echo "<p>Dogodila se pogreška!</p>";
            echo "<a href='index.php'>Povratak</a>";
        } else {
            $column = htmlentities($_POST['column']);
        }
        if (!isset($_POST['file'])) {
            echo "<p>Dogodila se pogreška!</p>";
            echo "<a href='index.php'>Povratak</a>";
        } else {
            $file = htmlentities($_POST['file']);
        }

        search_results($connection,$term,$table,$column,$file);

    }else {
        echo "<p>Dogodila se pogreška!</p>";
        echo "<a href='" . $file . ".php'>Povratak</a>";
    }
    include_once("footer.php");
?>