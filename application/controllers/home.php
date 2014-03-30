<?php
class home extends controller {

	function index()
	{

		$categories_sql_string = "SELECT * FROM category";

        require_once('application/models/database.class.php');
        $connection = new Database("sbrettsc_db");

        $menu_array = $connection->get_array_from_query($categories_sql_string);
        $data = array("menu_array"=>$menu_array);
		$this->LoadView("pages/home", $data);
	}

	function shoppingcart(){
		$cart = $_SESSION->get_cart();

		$this->LoadView("pages/cart", $cart);
	}
}
