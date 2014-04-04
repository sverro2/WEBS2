<?php

class admin extends controller {

    public function is_logged_in() {
        if(isset($_SESSION['shopping_cart'])){
            $loged_in = $_SESSION['shopping_cart']->is_admin();
        }else{
            $loged_in = false;
        }

        if (!$loged_in) {
            $cred = $this->loadModel("model_login")->get_admin_account_credentials();
            $this->LoadView("editors/login", $cred);
            return false;
        } else {
            return true;
        }
    }

    public function index() {
        if (!$this->is_logged_in())
            return false;            //check if user had been logged in!!!
        $categories_sql_string = "SELECT * FROM category";

        $connection = new Database("sbrettsc_db");

        $menu_array = $connection->get_array_from_query($categories_sql_string);
        $data = array("menu_array" => $menu_array);
        $this->LoadView("pages/home", $data);
    }

    private function category() {
        if ($this->is_logged_in()){
            return true;            //check if user had been logged in!!!
        }else{
            exit;
        }
    }

    public function add_category() {
        $this->category();
        $this->loadView("editors/category_editor");
    }

    public function delete_category($id) {
        $this->category();

        $connection = new Database("sbrettsc_db");
        $connection->do_sql("DELETE FROM category WHERE id = " . $id);
        $this->index();

    }

    public function edit_category($category) {
        $this->category();
        $categories_sql_string = "SELECT * FROM category WHERE id = " . $category . " limit 1";
        $connection = new Database("sbrettsc_db");
        $menu_array = $connection->get_array_from_query($categories_sql_string);
        $data = array("menu_array" => array_shift($menu_array));

        $this->loadView("editors/category_editor", $data);
    }

    private function product() {
        if ($this->is_logged_in()){
            return true;            //check if user had been logged in!!!
        }else{
            exit;
        }
    }

    public function add_product() {
        $this->product();
    }

    public function remove_product() {
        $this->product();
    }

    public function edit_product($product) {
        $this->product();
        $categories_sql_string = "SELECT * FROM category";
        $specifications_sql_string = "SELECT * FROM specification";
        $connection = new Database("sbrettsc_db");
        $categories = $connection->get_array_from_query($categories_sql_string);
        $specifications = $connection->get_array_from_query($specifications_sql_string);
        $data = $this->LoadModel("model_product")->get_details($product);
        $data['categories'] = $categories;
        $data['speclist'] = $specifications;
        $this->loadView("editors/product_editor", $data);
    }

}
