<?php
//controller for misc pages
class home extends controller {

    //home page
	function index()
	{
            $categories_sql_string = "SELECT * FROM category";

            $connection = new Database("sbrettsc_db");

            $menu_array = $connection->get_array_from_query($categories_sql_string);
            $data = array("menu_array"=>$menu_array);
            $this->LoadView("pages/home", $data);
	}

    //shopping cart view
	function shoppingcart(){
		$cart = @ $_SESSION['shopping_cart'];
                $data = array();
                
                if(isset($cart)){
                    foreach(array_keys($cart->get_cart()) as $id){
                        $prepared_row = $this->LoadModel("model_product")->get_details($id);
                        $value = $cart->get_cart();
                        $prepared_row['amount_in_cart'] = $value[$id];
                        array_push($data, $prepared_row);
                    }  
                }
                
		$this->LoadView("pages/cart",$data);
	}
    
    //about page view
    function about(){
        $about_query = "SELECT * FROM texts WHERE name = 'about' LIMIT 1";

        $connection = new Database("sbrettsc_db");

        $about_array = $connection->get_array_from_query($about_query);
        $data = array_shift($about_array);

        $data = array("about"=>$data);
        $this->LoadView("pages/about", $data);
    }
}
