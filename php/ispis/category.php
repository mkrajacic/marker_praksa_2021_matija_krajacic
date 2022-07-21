<?php
    $title = "Proizvodi iz kategorije";
    include_once("header.php");

    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];
        $count = getJoinResults("SELECT count(*) as total FROM product INNER JOIN product_category ON product_category.product_id = product.id WHERE product.active=1 AND product_category.category_id =" . $category_id . " LIMIT 1",$connection);

        if ($count) {
            $count_row = mysqli_fetch_assoc($count);
            $nmbr_products = $count_row['total'];
        }
    } else {
        throwError();
    }

    $page = (empty($_GET['page'])) ? 1 : (int) $_GET['page'];
    $nmbrPage = getNmbrPage($nmbr_products, $limit);
    $offset = getOffset($limit, $page, $nmbrPage);

    $orderBy = "product.id DESC";
    
    if (isset($_GET['sortby'])) {
        $sortBy = $_GET['sortby'];
        $orderBy = setOrderBy($sortBy);
    }

     $products = getJoinResults("SELECT product.id,product.name,GROUP_CONCAT(product_image.photo SEPARATOR ', ') AS 'photos',product.discount,product.price_final FROM product INNER JOIN product_image ON product.id = product_image.product_id INNER JOIN product_category ON product_category.product_id = product.id WHERE product.active=1 AND product_category.category_id =" . $category_id . " GROUP BY product.id ORDER BY " . $orderBy . " LIMIT " . $limit . " OFFSET " . $offset,$connection);

    ?>

<body>
    <div class="special-products">
        <h1>Proizvodi iz kategorije<span class="cart"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;</a></span></h1>
    </div>

    <div class='special'>
        <div class="sort">
            <p><a href="category.php?id=<?php echo $category_id ?>&sortby=newest">Prvo najnoviji</a></p>
            <p><a href="category.php?id=<?php echo $category_id ?>&sortby=oldest">Prvo najstariji</a></p>
            <p><a href="category.php?id=<?php echo $category_id ?>&sortby=cheapest">Prvo najjeftiniji</a></p>
            <p><a href="category.php?id=<?php echo $category_id ?>&sortby=expensive">Prvo najskuplji</a></p>
            <br>
            <p><a href="index.php">Povratak</a></p>
        </div>
        <?php


        if($nmbr_products==0){
            echo "<p class='no-results'>Nema proizvoda unutar odabrane kategorije!</p>";
        }

        if ($products) {
            while ($product_row = $products->fetch_assoc()) {
                  ?>
                        <div class="special_product">

                            <?php $images = explode(", ", $product_row['photos']);    ?>
                            <img class="special_image" src="fotografije/<?php echo $images[0] ?>">
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
    <?php
    pagination_display($page, $nmbrPage);
    ?>
</body>

</html>