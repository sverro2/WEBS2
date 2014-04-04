<?php
ini_set('display_errors',1);
require_once("database.class.php");
new productsave;

class productsave {

    public $connection;
    public $input_array;
    public $connector;

    public function __construct() {
        $this->connection = new Database('sbrettsc_db');
        $this->input_array = json_decode($_POST['save_product']);
        $this->connector = $this->connection->get_connection();
        foreach ($this->input_array as $key => $value) {
            switch ($key) {
                case 'upload_info':
                    $this->upload_info($this->input_array->upload_info);
                    break;
                case 'upload_description':
                    $this->upload_description($this->input_array->upload_description);
                    break;
                case 'set_specification':
                    $this->set_specification($this->input_array->set_specification);
                    break;
                default:
                    echo 'Error: action ' . $key . ' is not known!';
            }
        }
    }

    private function upload_info($base) {
        $category_id = $this->connection->get_array_from_query("SELECT id FROM category WHERE label='" . $base->category . "';");
        $cat_id = $category_id[0]['id'];
        
        if(isset($cat_id)){
        $this->connection->do_sql("
            UPDATE product
            SET price=" . $this->connector->real_escape_string($base->price) . "
            , title='" . $this->connector->real_escape_string($base->title) . "'
            , fullname='" . $this->connector->real_escape_string($base->fullName) . "'
            , category_id=" . $this->connector->real_escape_string($cat_id) . " WHERE id=" . $base->id .";");   
        echo 'Updated product Info!';
        }
    }
    
    private function upload_description($base){
        $this->connection->do_sql("
            UPDATE product
            SET description='" . $this->connector->real_escape_string($base->description) . "'
            WHERE id = " . $base->id . ";");
        print_r($base);
    }
    
    private function set_specification($base){
        if($base->spec !== "" && $base->value !== ""){
            $spec_exists_query = "SELECT id, count(spec) as c FROM specification WHERE spec='" . $base->spec . "';";
            $exists = $this->connection->get_array_from_query($spec_exists_query);
            $already_existed=false;
            
            if($exists[0]['c'] != 0){
                echo 'spec bestaat';
                $id = $exists[0]['id'];
                echo $id;
                $already_existed=true;
            }else{
                $this->connection->do_sql("
                    INSERT INTO specification (spec)
                    VALUES ('" . $base->spec . "')
                    ");
                $id = $this->get_spec_id($base->spec);
                
                if($id == 0){
                    echo 'An error occured... Could not find spec id';
                }
            }
            
            if($already_existed){
                $double = $this->check_specs_product($base->id, $base->spec);
                if($double){
                    $query_update_value = "";
                }
                echo $double . " ENDED";
            }else{
                
            }
        }else{
            echo "No specification set (missing arguments spec/value)";
        }
    }
    
    private function get_spec_id($string){
        $spec_exists_query = "SELECT id FROM specification WHERE spec='" . $string . "';";
        $id = $this->connection->get_array_from_query($spec_exists_query);
        
        return $id;
    }
    
    private function check_specs_product($product_id, $spec){
        $query = "SELECT count(spec) as c
            FROM product_specification 
            JOIN specification 
            ON specification.id = product_specification.spec_id 
            WHERE spec='" . $spec . "' AND product_id=" . $product_id . ";";
        
        $array = $this->connection->get_array_from_query($query);
        
        if($array[0]['c'] >= 1){
            echo 'item has already this spec!';
            return true;
        }else{
            return false;
        }
        
    }

}
