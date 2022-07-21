<?php
    $pass = 1;

        if (ctype_space($_POST['quantity'])) {

            $pass = 0;       
            $error = "Niste upisali količinu!";

        } else {
            $quantity = htmlentities($_POST['quantity']);
        }
        if (ctype_space($_POST['price'])) {

            $pass = 0;
            $error = "Niste upisali cijenu!";

        } else {
            $price = htmlentities($_POST['price']);
        }

        

?>