<?php
    $pass = 1;

        if (ctype_space($_POST['name'])) {

            $pass = 0;       
            $error = "Niste upisali ime kupca!";

        } else {
            $name = htmlentities($_POST['name']);
        }
        if (ctype_space($_POST['surname'])) {

            $pass = 0;
            $error = "Niste upisali prezime kupca!";

        } else {
            $surname = htmlentities($_POST['surname']);
        }

        if (ctype_space($_POST['address'])) {

            $pass = 0;
            $error = "Niste upisali adresu kupca!";

        } else {
            $address = htmlentities($_POST['address']);
        }

        if (ctype_space($_POST['email'])) {

            $pass = 0;
            $error = "Niste upisali email kupca!";

        } else {
            $email = htmlentities($_POST['email']);
        }

        if (!isset($_POST['status']) || $_POST['status']==0) {
            $status = 2;
        } else {
            $status = $_POST['status'];
        }

?>