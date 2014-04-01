<?php
class category extends controller {

	function show($url)
	{
		$data = $this->LoadModel("model_category")->get_all_by_url($url);
                if (!empty($data['category_data'])){
                    $this->LoadView("pages/category", $data);
                }
	}

	function product($id)
	{
		$data = $this->LoadModel("model_product")->get_details($id);
                $cart = @ $_SESSION['shopping_cart'];
                if(isset($cart)){
                    $data['added_to_cart'] = $cart->exists_cart($id);
                }
                if (isset($data['title'])){
                    $this->LoadView("pages/product", $data);
                }
	}
}
