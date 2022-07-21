<?php
        $query = "SELECT * FROM category ORDER BY id";
        $result = $connection->query($query, MYSQLI_STORE_RESULT);

        $brand_query = "SELECT * FROM brand ORDER BY id";
        $brand_select = $connection->query($brand_query, MYSQLI_STORE_RESULT);

        $category_query = "SELECT * FROM category ORDER BY id";
        $category = $connection->query($category_query, MYSQLI_STORE_RESULT);

        $category_products_query = "SELECT * FROM product_category ORDER BY id";
        $category_products = $connection->query($category_products_query, MYSQLI_STORE_RESULT);

        $products_query = "SELECT * FROM product ORDER BY id";
        $products = $connection->query($products_query, MYSQLI_STORE_RESULT);

        $order_query = "SELECT orders.id AS 'order_id',orders.name AS order_name, orders.surname AS order_surname, orders.address AS order_address, orders.email AS 'order_email', order_status.status AS 'order_status', product.name AS 'product_name', product_order.quantity AS 'product_quantity', product_order.price AS 'product_price', GROUP_CONCAT(product.name SEPARATOR ', ') AS 'products', SUM(product_order.price) AS 'total', SUM(product_order.quantity) AS 'total_quantity' FROM orders INNER JOIN product_order ON orders.id = product_order.order_id INNER JOIN product ON product_order.product_id = product.id INNER JOIN order_status ON order_status.id = orders.status GROUP BY order_id";
        $order_products = $connection->query($order_query, MYSQLI_STORE_RESULT);

        $page_query = "SELECT * FROM " .  $table . " ORDER BY id ASC LIMIT " . $limit . " OFFSET " . $offset;
        $page_results = $connection->query($page_query, MYSQLI_STORE_RESULT);

        $order_status_query = "SELECT orders.status, order_status.status, order_status.id FROM orders INNER JOIN order_status ON orders.status = order_status.id";
        $order_status = $connection->query($order_status_query, MYSQLI_STORE_RESULT);

        $os_query = "SELECT * FROM order_status ORDER BY id";
        $os = $connection->query($os_query, MYSQLI_STORE_RESULT);

?>