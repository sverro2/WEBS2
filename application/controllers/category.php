<?php
class category extends controller {
    function index(){
        $this->redirect('home/index');
    }

    function show($url)
    {

        $cart = @ $_SESSION['shopping_cart'];
        $data = $this->LoadModel("model_category")->get_all_by_url($url);

        if(isset($cart)){
            $is_in_cart = array();
            foreach ($data['product_array'] as $item){
                $is_in_cart[$item['id']] = $cart->exists_cart($item['id']);
            }

            $is_in_stock = array();
            foreach ($data['product_array'] as $item){
                $is_in_stock[$item['id']] = $item['stock'];
            }

            $data['is_in_cart'] = $is_in_cart;
            $data['is_in_stock'] = $is_in_stock;
        }

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

    function search($pat)
    {
        $cart = @ $_SESSION['shopping_cart'];
        $data = $this->LoadModel("model_product")->search($pat);
        if(isset($cart)){
            $is_in_cart = array();
            foreach ($data['product_array'] as $item){
                $is_in_cart[$item['id']] = $cart->exists_cart($item['id']);
            }

            $is_in_stock = array();
            foreach ($data['product_array'] as $item){
                $is_in_stock[$item['id']] = $item['stock'];
            }

            $data['is_in_cart'] = $is_in_cart;
            $data['is_in_stock'] = $is_in_stock;
        }

        if (!empty($data['category_data'])){
            $this->LoadView("pages/category", $data);
        }
    }
}
