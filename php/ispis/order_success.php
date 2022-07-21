<?php
$title = "Narudžba kreirana!";
include_once("header.php");

    unset($_SESSION);
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();
?>

<body>
    <div class="special-products">
        <h1>Hvala!</h1>
    </div>
    <div class='special'>
        <div class="sort">
            <p><a href="index.php">Početna stranica</a></p><br>
        </div>
        <div class="special_product">
            <h3 class="product_discount">
                Narudžba je uspješno kreirana, zahvaljujemo što se kupovali kod nas!
            </h3>
        </div>
    </div>
</body>

</html>