<?php
    $connection = new mysqli('localhost','admin','admin5','praksa');
    if($connection->connect_errno) {
        echo "<p>Neuspjelo povezivanje na bazu " . $connection->connect_error . "</p>";
        die();
    }
?>