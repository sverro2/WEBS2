<?php

class Structure{
    
    private $connection;
    private $menu_sql_string = "SELECT b.id, a.label, link, b.label child_label, url child_link FROM menu_top a LEFT JOIN category b ON parent_label = a.label ORDER BY a.sort;";
    
    public function __construct() {
        require 'application/models/database.class.php';
        $this->connection = new Database("sbrettsc_db");
    }
    
    public function display_menu(){
        $menu_array = $this->connection->get_array_from_query($this->menu_sql_string);
      
        echo "<ul class='nav'><li><input type='text' placeholder='Zoek' id='searchbar' class='menuitem' /></li>" . PHP_EOL;
        $previous_menu = null;

        foreach ($menu_array as $row){

            if($row['child_label'] == NULL){
                echo "\t\t\t<li><a href='?route=home/" . $row['link'] . "' class='menuitem'>" . $row['label'] . "</a></li>" . PHP_EOL;
            }elseif($previous_menu != $row['label']){
                echo "<li id='" . $row['link'] . "'>";
                $this->display_children($menu_array, $row['label']);
                echo '</li>';

                $previous_menu = $row['label'];
            }

        } 
        echo "\t\t</ul>" . PHP_EOL;
    }
    
    private function display_children($menu_array, $child){
        $menu_set = FALSE;
        foreach ($menu_array as $row){
            if ($row['label'] == $child){
                if(!$menu_set){
                    echo "<a href='?route=home/" . $row['link'] . "' class='menuitem'>" . $row['label'] . "</a>". PHP_EOL;
                    echo '<ul>'. PHP_EOL;
                    $menu_set = TRUE;
                }

                echo "\t\t\t\t<li><a href='?route=category/show/" . $row['child_link'] . "' class='menuitem'>" . $row['child_label'] . "</a></li>" . PHP_EOL;
            }        

        } 
        echo "\t\t\t</ul>" . PHP_EOL;
    }
    
    public function display_breadcrumbs($current_url){
        $origin = substr($current_url, strpos($current_url, "=") + 1);
        if(strpos($current_url, "=")){
            echo '<div id="breadcrumb">' . PHP_EOL;
                echo $origin;
            echo '</div>' . PHP_EOL;
        }
        
    }
}

