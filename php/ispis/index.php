<?php
$title = "Početna";
include_once("header.php");

$items = array();

$main = executeQuery("id,main_id,name", "category", null, "id", $connection);
if ($main) {
    while ($main_row = $main->fetch_assoc()) {
        $arr = array('id' => $main_row['id'], 'main_id' => $main_row['main_id'], 'name' => $main_row['name']);
        $items[] = $arr;
    }
}

$childs = array();

foreach ($items as &$item) {
    $childs[$item['main_id']][] = &$item;
    unset($item);
}

foreach ($items as &$item) {
    if (isset($childs[$item['id']])) {
        $item['childs'] = $childs[$item['id']];
        unset($item);
    }
}

$tree = $childs[0];

function buildTree($items)
{
    $childs = array();

    foreach ($items as &$item) {
        $childs[(int)$item['main_id']][] = &$item;
    }

    foreach ($items as &$item) {
        if (isset($childs[$item['id']])) {
            $item['childs'] = $childs[$item['id']];
        }
    }

    return $childs[0];
}

$tree = buildTree($items);

?>

<body>
    <div class="wrapper">
        <div class="grid-container">
            <?php
            foreach ($items as $category) {
                if ($category['main_id'] == 0) {
            ?>
                    <div class="grid-item">
                        <p>
                            <a href='category.php?id=<?php echo $category['id'] ?>' class='category_link'><?php echo $category['name'] ?></a>
                        </p>
                        <ul>
                            <?php
                            if (isset($category['childs'])) {
                                foreach ($category['childs'] as $sub) {
                                    echo "<li><a href='category.php?id=" . $sub['id'] . "'>" . $sub['name'] . "</a></li><br>";
                                    if (isset($sub['childs'])) {
                                        foreach ($sub['childs'] as $subsub) {
                                            echo "<li><a href='category.php?id=" . $subsub['id'] . "'>--" . $subsub['name'] . "</a></li><br>";
                                            if (isset($subsub['childs'])) {
                                                foreach ($subsub['childs'] as $subsubsub) {
                                                    echo "<li><a href='category.php?id=" . $subsubsub['id'] . "'>-----" . $subsubsub['name'] . "</a></li><br>";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
            <?php

                }
            }
            ?>
        </div>
        <div class="special-products">
            <h1>Izdvojeno<span class="cart"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;</a></span></h1>
        </div>
        <div class='special'>
            <?php
            $ps = getJoinResults("SELECT product.id,product.name,product_image.photo,GROUP_CONCAT(product_image.photo SEPARATOR ', ') AS 'photos',product.discount,product.price_final FROM product INNER JOIN product_image ON product.id = product_image.product_id WHERE product.special=1 AND product.active=1 GROUP BY product.id;", $connection);
            if ($ps) {
                while ($product_row = $ps->fetch_assoc()) {
            ?>

                    <div class="special_product">

                        <?php
                        $images = explode(", ", $product_row['photos']);

                        ?>
                        <img class="special_image" src="fotografije/<?php echo $images[0] ?>">
                        <?php     ?>
                        <h3 class="product_name">
                            <?php echo $product_row['name'] ?>
                        </h3>
                        <h3 class="product_discount">
                            <?php echo $product_row['discount'] ?>% popusta
                        </h3>
                        <h3 class="product_price">
                            <?php echo $product_row['price_final'] ?>kn
                        </h3>

                        <a href="product_details.php?id=<?php echo $product_row['id'] ?>"><button type="button" class="button_details">Detalji</button></a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>