<?php
    $pass = 1;

        if (!isset($_POST['active'])) {
            $active = 0;
        } else {
            $active = $_POST['active'];
        }
        if (!isset($_POST['main'])) {
            $main = 1;
        } else {
            $main = $_POST['main'];
        }
        if (ctype_space($_POST['category'])) {

            $pass = 0;       
            $error = "Niste upisali naziv kategorije!";

        } else {
            $category = htmlentities($_POST['category']);
        }
        if (ctype_space($_POST['description'])) {

            $pass = 0;
            $error = "Niste upisali opis kategorije!";

        } else {
            $description = htmlentities($_POST['description']);
        }
?>