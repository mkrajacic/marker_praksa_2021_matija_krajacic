<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manipulacija podacima</title>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        body {
            color: aliceblue;
            background-color: #396582;
        }

        .menu a {
            font-family: 'Montserrat', sans-serif;
        }

        label {
        font-family: 'Montserrat', sans-serif;
        }

        a {
            text-decoration: none;
            color: beige;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: whitesmoke;
            font-family: 'Ubuntu', sans-serif;
            font-weight:300;
        }

        h5 {
            font-size: 15px
        }

        p {
            font-style: italic;
        }

        .menu {
            list-style-type: none;
        }

        .menu-item {
            display: inline-block;
            padding-left: 3%;
        }

        .menu-link {
            text-decoration: none;
        }

        .pagination {
            list-style-type: none;
        }

        .pagination li {
            display: inline-block;
            padding-left: 10px;
            padding-top: 10px;
        }

        .page-item {
            color: #6ce3ff;
        }

        input[type='text'] {
            background-color: aliceblue
        }

        .delete_button {
            border-radius: 30px;
            background-color: red;
            color: aliceblue;
            width: 60px;
            font-family: 'Open Sans', sans-serif;
            font-weight:600;
            border-color:red;
        }

        .edit_button {
            border-radius: 30px;
            background-color: goldenrod;
            color: aliceblue;
            width: 60px;
            font-family: 'Open Sans', sans-serif;
            font-weight:600;
            border-color:goldenrod;
        }

        .navigation_button {
            border-radius: 30px;
            background-color: aliceblue;
            color: black;
            width: 110px;
            font-family: 'Open Sans', sans-serif;
            font-weight:600;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <?php
    include_once("connection.php");
    ?>
</head>

<body>
    <nav class="navigation">
        <ul class="menu">
            <li class="menu-item">
                <a class="menu-link" href="index.php">Kategorije</a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="products.php">Proizvodi</a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="brands.php">Brendovi</a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="orders.php">Narudžbe</a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="customers.php">Kupci</a>
            </li>
        </ul>
    </nav>