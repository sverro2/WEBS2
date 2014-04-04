<?php
//controller for admin processes
class admin extends controller {
    //all admin actions will refer to this method, which will redirect the user to a login screen if he is not logged in as an admin
    public function is_logged_in() {
        if(isset($_SESSION['shopping_cart'])){
            $loged_in = $_SESSION['shopping_cart']->is_admin();
        }else{
            $loged_in = false;
        }

        if (!$loged_in) {
            //$cred = $this->loadModel("model_login")->get_admin_account_credentials();
            $this->LoadView("editors/login");
            return false;
        } else {
            return true;
        }
    }
    //index page that will redirect you to the login screen if you are not an admin
    public function index() {
        if (!$this->is_logged_in())
            return false;            //check if user had been logged in!!!
        $categories_sql_string = "SELECT * FROM category";

        $connection = new Database("sbrettsc_db");

        $menu_array = $connection->get_array_from_query($categories_sql_string);
        $data = array("menu_array" => $menu_array);
        $this->LoadView("pages/home", $data);
    }

    //a procedure for all category functions to check if the user is an admin
    private function category() {
        if ($this->is_logged_in()){
            return true;            //check if user had been logged in!!!
        }else{
            exit;
        }
    }

    //move to the add category page
    public function add_category() {
        $this->category();
        $this->loadView("editors/category_editor");
    }

    //delete a category and redirect to index
    public function delete_category($id) {
        $this->category();

        $connection = new Database("sbrettsc_db");
        $connection->do_sql("DELETE FROM category WHERE id = " . $id);
        $this->index();

    }

    //load the category edit page
    public function edit_category($category) {
        $this->category();
        $categories_sql_string = "SELECT * FROM category WHERE id = " . $category . " limit 1";
        $connection = new Database("sbrettsc_db");
        $menu_array = $connection->get_array_from_query($categories_sql_string);
        $data = array("menu_array" => array_shift($menu_array));

        $this->loadView("editors/category_editor", $data);
    }

    //same as category, function for all products
    private function product() {
        if ($this->is_logged_in()){
            return true;            //check if user had been logged in!!!
        }else{
            exit;
        }
    }

    //add product view
    public function add_product() {
        $this->product();
    }

    //remove product view
    public function remove_product() {
        $this->product();
    }

    //edit product view
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
