<?php
class model_product extends model {

    function get_details( $id ){
        $product_id = $id;
        $product_query = "SELECT * FROM product WHERE id = " . $product_id . " LIMIT 1";
        $spec_query = "SELECT spec, spec_value FROM product_specification AS ps JOIN specification AS s ON ps.spec_id = s.id WHERE product_id = " . $product_id;
        $img_query = "SELECT url FROM image WHERE product_id = " . $product_id;
        $yt_query = "SELECT url FROM youtube WHERE product_id = " . $product_id;

        require_once('application/models/database.class.php');
        $connection = new Database("sbrettsc_db");

        $product_data_array = $connection->get_array_from_query($product_query);
        $product_specs_array = $connection->get_array_from_query($spec_query);
        $product_images_array = $connection->get_array_from_query($img_query);
        $product_videos_array = $connection->get_array_from_query($yt_query);
        $product_data = array_shift($product_data_array);

        $image = $product_data['defaultimage'];
        $title = $product_data['title'];
        $price = $product_data['price'];
        $fullname = $product_data['fullname'];
        $description = $product_data['description'];
        $stock = $product_data['stock'];

        return array(
            "product_id" => $id,
            "image"=>$image,
            "title"=>$title,
            "price"=>$price,
            "fullname"=>$fullname,
            "description"=>$description,
            "stock"=>$stock,
            "product_specs_array"=>$product_specs_array,
            "product_videos_array"=>$product_videos_array,
            "product_images_array"=>$product_images_array
        );
    }

    function search($pat){
        require_once("application/models/database.class.php"); 
        $connection = new Database("sbrettsc_db");

        $product_query = "CALL search('" . $pat . "')";

        $product_array = $connection->get_array_from_query($product_query);

        $category_data = array(
                "label"=>"search",
                "thumbnail"=>"img/search.png"
            );
        $search = array(
                "term"=>$pat,
                "results"=>count($product_array)
            );

        return array("product_array"=>$product_array, "category_data"=>$category_data,"search"=>$search);
    }

}
