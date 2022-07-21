<?php

    $pass = 1;

    if (!isset($_POST['active_product'])) {
        $active = 0;
    } else {
        $active = $_POST['active_product'];
    }
    if (!isset($_POST['forbidden'])) {
        $forbidden = 0;
    } else {
        $forbidden = $_POST['forbidden'];
    }
    if (!isset($_POST['special'])) {
        $special = 0;
    } else {
        $special = $_POST['special'];
    }
    if (ctype_space($_POST['product'])) {

        $pass = 0;
        $error = "Niste upisali naziv proizvoda!";

    } else {
        $name = htmlentities($_POST['product']);
    }
    if (ctype_space($_POST['product_description'])) {

        $pass = 0;
        $error = "Niste upisali opis proizvoda!";

    } else {
        $product_description = htmlentities($_POST['product_description']);
    }
    if (ctype_space($_POST['price_base'])) {

        $pass = 0;
        $error = "Niste upisali osnovnu cijenu!";

    } else {
        $price_base = htmlentities($_POST['price_base']);
    }
    if (ctype_space($_POST['price_final'])) {

        $pass = 0;
        $error = "Niste upisali finalnu cijenu!";

    } else {
        $price_final = htmlentities($_POST['price_final']);
    }
    if (ctype_space($_POST['available'])) {

        $pass = 0;
        $error = "Niste upisali dostupnu količinu!";

    } else {
        $available = htmlentities($_POST['available']);
    }
    if ($_POST['product_category']==0) {

        $pass = 0;
        $error = "Niste odabrali kategoriju!";

    } else {
        $product_category = $_POST['product_category'];
    }
    if ($_POST['brand_select']==0) {

        $pass = 0;
        $error = "Niste odabrali brend!";

    } else {
        $brand_id = $_POST['brand_select'];
    }
    if (!isset($_POST['discount'])) {
        $discount = 0;
    } else {
        $discount = $_POST['discount'];
    }
?>