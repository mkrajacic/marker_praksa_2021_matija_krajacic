<?php
    $pass = 1;

    if (!isset($_POST['active'])) {
        $active = 0;
    } else {
        $active = $_POST['active'];
    }
    if (ctype_space($_POST['brand'])) {
        $pass = 0;
        $error = "Niste upisali naziv brenda!";
    } else {
        $brand = htmlentities($_POST['brand']);
    }
    if (ctype_space($_POST['description'])) {
        $pass = 0;
        $error = "Niste upisali opis brenda!";
    } else {
        $description = htmlentities($_POST['description']);
    }
?>