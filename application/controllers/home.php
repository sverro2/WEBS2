<?php
class home extends controller {

	function index()
	{
            $categories_sql_string = "SELECT * FROM category";

            $connection = new Database("sbrettsc_db");

            $menu_array = $connection->get_array_from_query($categories_sql_string);
            $data = array("menu_array"=>$menu_array);
            $this->LoadView("pages/home", $data);
	}

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
        
        function about(){
            $this->LoadView("pages/about");
        }
}
