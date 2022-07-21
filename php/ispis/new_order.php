<?php
$title = "Nova narudžba";
include_once("header.php");

if (!isset($_SESSION['ordered_products']) || !isset($_SESSION['total']) || !isset($_SESSION['count_products'])) {
    throwError();
}
?>

<body>
    <div class="special-products">
        <h1>Kreiranje narudzbe</h1>
    </div>
    <div class='special'>
        <div class="sort">
            <p><a href="index.php">Početna stranica</a></p><br>
            <p><a href="cart.php">Povratak na košaricu</a></p>
        </div>
        <?php
        $fields = array('return_name','return_surname','return_email','return_address');

        foreach($fields as $field) {
            if(!empty($_SESSION["$field"])) {
                ${$field} = $_SESSION["$field"];
            }else {
                ${$field} = "";
            }
        }

        ?>
            <form method='post' action='new_order_confirmation.php' class="order_form">
                <input type='hidden' id='submitted' name='submitted'>
                <label for='name'>Ime:</label><br>
                <input type='text' id='name' name='name' value="<?php echo $return_name ?>" required><br><br>
                <label for='surname'>Prezime:</label><br>
                <input type='text' id='surname' name='surname' value="<?php echo $return_surname ?>" required><br><br>
                <label for='email'>E-mail adresa:</label><br>
                <input type='email' id='email' name='email' value="<?php echo $return_email ?>" required><br><br>
                <label for='address'>Adresa dostave:</label><br>
                <input type='text' id='address' name='address' value="<?php echo $return_address ?>" required><br><br>
                <button type="submit" class="cart_button">Potvrdi</button>
            </form>
    </div>
</body>

</html>