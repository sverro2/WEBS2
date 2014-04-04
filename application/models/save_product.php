<?php
ini_set('display_errors',1);
require_once("database.class.php");
$saver = new productsave;

class productsave {

    public $connection;
    public $input_array;

    public function __construct() {
        $this->connection = new Database('sbrettsc_db');
        $this->input_array = json_decode($_POST['save_product']);
        foreach ($this->input_array as $key => $value) {
            switch ($key) {
                case 'upload_info':
                    $this->upload_info($this->input_array->upload_info);
                    break;
                case 'other_stuff':
                    echo "and do something else";
                    break;
                default:
                    echo 'no action';
            }
        }
    }

    function upload_info($base) {
        $category_id = $this->connection->get_array_from_query("SELECT id FROM category WHERE label='" . $base->category . "';");
        $cat_id = $category_id[0]['id'];
        
        if(isset($cat_id)){
        $this->connection->do_sql("
            UPDATE product
            SET price=" . $base->price . "
            , title='" . $base->title . "'
            , fullname='" . $base->fullName . "'
            , category_id=" . $cat_id . " WHERE id=" . $base->id .";");   
        echo 'Updated product Info!';
        }
    }

}
