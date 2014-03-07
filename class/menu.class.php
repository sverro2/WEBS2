<?php

class Structure{
    
    private $connection;
    private $menu_sql_string = "SELECT a.label, link, b.label child_label, url child_link FROM menu_top a LEFT JOIN category b ON parent_label = a.label ORDER BY a.sort;";
    
    public function __construct() {
        require './class/database.class.php';
        $this->connection = new Database("sbrettsc_db");
    }
    
    public function display_menu(){
        $menu_array = $this->connection->get_array_from_query($this->menu_sql_string);
      
        echo "<ul class='nav'>" . PHP_EOL;
        $previous_menu = null;

        foreach ($menu_array as $row){

            if($row['child_label'] == NULL){
                echo "\t\t\t<li><a href='" . $row['link'] . "'>" . $row['label'] . "</a></li>" . PHP_EOL;
            }elseif($previous_menu != $row['label']){
                echo '<li>';
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
                    echo "<a href='" . $row['link'] . "'>" . $row['label'] . "</a>". PHP_EOL;
                    echo '<ul>'. PHP_EOL;
                    $menu_set = TRUE;
                }

                echo "\t\t\t\t<li><a href='" . $row['child_link'] . "'>" . $row['child_label'] . "</a></li>" . PHP_EOL;
            }        

        } 
        echo "\t\t\t</ul>" . PHP_EOL;
    }
}

