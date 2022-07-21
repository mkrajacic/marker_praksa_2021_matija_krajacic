<?php
include_once("header.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    throwError();
}
if (isset($_GET['cid'])) {
    $cart_id = $_GET['cid'];
} else {
    throwError();
}

$delete_product = $connection->prepare("DELETE FROM product_cart WHERE cart_id=? AND product_id=?");
$delete_product->bind_param('ii', $cart_id,$product_id);

if ($delete_product->execute()) {
    header("Location: cart.php?deleted=1");
}else {
    header("Location: cart.php?deleted=2");
}

?>