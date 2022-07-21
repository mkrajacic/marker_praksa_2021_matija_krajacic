<?php
    $pass = 1;

        if (ctype_space($_POST['name'])) {

            $pass = 0;
            $error = "Niste upisali ime!";

        } else {
            $name = htmlentities($_POST['name']);
        }

        if (ctype_space($_POST['surname'])) {

            $pass = 0;
            $error = "Niste upisali prezime!";

        } else {
            $surname = htmlentities($_POST['surname']);
        }

        if (ctype_space($_POST['email'])) {

            $pass = 0;
            $error = "Niste upisali email!";

        } else {
            $email = htmlentities($_POST['email']);
        }

        if (ctype_space($_POST['password'])) {

            $pass = 0;
            $error = "Niste upisali lozinku!";

        } else {
            $password = htmlentities($_POST['password']);
            $password_encrypted = password_hash($password, PASSWORD_BCRYPT);
        }
?>