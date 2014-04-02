<?php
class admin extends controller {
        
    public function is_logged_in(){
        $loged_in = $_SESSION['shopping_cart']->is_admin();
        
        if(!$loged_in){
            $cred = $this->loadModel("model_login")->get_admin_account_credentials();
            $this->LoadView("editors/login", $cred);
            return false;
        }else{
            return true;
        }
    }
    
    public function index()
    {
        if(!$this->is_logged_in()) return false;            //check if user had been logged in!!!
        $categories_sql_string = "SELECT * FROM category";

        $connection = new Database("sbrettsc_db");

        $menu_array = $connection->get_array_from_query($categories_sql_string);
        $data = array("menu_array"=>$menu_array);
        $this->LoadView("pages/home", $data);
    }

    private function category(){
        if(!$this->is_logged_in()) return false;            //check if user had been logged in!!!
    }
    
    public function add_category(){
        $this->category();
    }
    
    public function remove_category(){
        $this->category();
    }
    
    public function edit_category($category){
        $this->category();
        $categories_sql_string = "SELECT * FROM category";
        $connection = new Database("sbrettsc_db");
        $menu_array = $connection->get_array_from_query($categories_sql_string);
        $data = array("menu_array"=>$menu_array);
        
        $this->loadView("editors/category_editor");
    }
    
    private function product(){
        if(!$this->is_logged_in()) return false;            //check if user had been logged in!!!
    }
    
    public function add_product(){
        $this->product();
    }
    
    public function remove_product(){
        $this->product();
    }
    
    public function edit_product($product){
        $this->product();
        $data = $this->LoadModel("model_product")->get_details($id);
        
        $this->loadView("editors/product_editor");
    }
}
