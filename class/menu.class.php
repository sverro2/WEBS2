<?php

class Structure{
    
    private $connection;
    private $menu_sql_string = "SELECT a.lable, link, b.lable child_lable, url child_link FROM Menu_top a LEFT JOIN Catagory b ON parent_lable = a.lable ORDER BY a.sort;";
    
    public function __construct() {
        require './class/database.class.php';
        $this->connection = new Database("sbrettsc_db");
    }
    
    public function display_menu(){
        $menu_array = $this->connection->get_array_from_query($this->menu_sql_string);
      
        echo "<ul class='nav'>" . PHP_EOL;
        $previous_menu = null;

        foreach ($menu_array as $row){

            if($row['child_lable'] == NULL){
                echo "\t\t\t<li><a href='" . $row['link'] . "'>" . $row['lable'] . "</a></li>" . PHP_EOL;
            }elseif($previous_menu != $row['lable']){
                echo '<li>';
                $this->display_children($menu_array, $row['lable']);
                echo '</li>';

                $previous_menu = $row['lable'];
            }

        } 
        echo "\t\t</ul>" . PHP_EOL;
    }
    
    private function display_children($menu_array, $child){
        $menu_set = FALSE;
        foreach ($menu_array as $row){
            if ($row['lable'] == $child){
                if(!$menu_set){
                    echo "<a href='" . $row['link'] . "'>" . $row['lable'] . "</a>". PHP_EOL;
                    echo '<ul>'. PHP_EOL;
                    $menu_set = TRUE;
                }

                echo "\t\t\t\t<li><a href='" . $row['child_link'] . "'>" . $row['child_lable'] . "</a></li>" . PHP_EOL;
            }        

        } 
        echo "\t\t\t</ul>" . PHP_EOL;
    }
}

