<?php
class model_category extends model {

	function get_all_by_url( $url ){

        require_once("application/models/database.class.php"); 
        $connection = new Database("sbrettsc_db");

		$product_query = "SELECT product.id as id, defaultimage, title, fullname, price FROM product JOIN category ON product.category_id = category.id WHERE category.url = '" . $url . "'";
		$category_query = "SELECT * FROM category WHERE url = '" . $url . "'";

	    $product_array = $connection->get_array_from_query($product_query);
	    $category_array = $connection->get_array_from_query($category_query);

	    $category_data = array_shift($category_array);
	    $category_image = $category_data['thumbnail'];

	    return array("product_array"=>$product_array, "category_data"=>$category_data, "category_image"=>$category_image);
	}

}
