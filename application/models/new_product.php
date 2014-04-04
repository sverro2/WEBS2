<?php

class new_product extends model {

    function create_new_product() {

        require_once("application/models/database.class.php");
        $connection = new Database("sbrettsc_db");
        
        $product_creation_query = "INSERT INTO product (price, title, fullname, description, defaultimage, category_id, stock)
VALUES (0, 'Untitled', 'Product Name', 'Product Description', 'product_add.png', 1, '100');";
        
        $connection->do_sql($product_creation_query);
        
        $highest_id_query = "SELECT max(id) as c FROM product;";
        $current_id = $connection->get_array_from_query($highest_id_query);

        return $current_id[0]['c'];
    }

}
