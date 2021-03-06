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
      
        echo "<ul class='nav'><li><input type='text' placeholder='Search...' id='searchbar' /></li>" . PHP_EOL;
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
    
    private function add_crumb($text, $url){
        return array('text' => $text, 'url' => $url);
    }
    
    private function print_crumbs($crumbs){
        echo "<script>print_crumbs(" . json_encode($crumbs) . ")</script>";
        /*
        echo '<div id="breadcrumb">' . PHP_EOL;
        foreach ($crumbs as $crumb){            
            if(empty($crumb['url'])){
                echo '<div class="selected">&gt; ' . $crumb['text'] . "</div>";;
            }else{
               echo '<a href="' . $crumb['url'] . '">';
               echo '<div class="unselected">&gt; ' . $crumb['text'] . "</div>";;
               echo "</a>"; 
            }
            
        }
        echo '</div>' . PHP_EOL;
        */
    }
    
    public function display_breadcrumbs($current_url){
        $origin = substr($current_url, strpos($current_url, "=") + 1);
        $stop = false;
        $crumbs = array();
        if(!strpos($current_url, "=")) return false;
        if($origin === "home/index") return false;
        $origin = explode("/", $origin);
        
        if($origin[0] === "home"){
            $crumbs[] = $this->add_crumb("Home", "?route=home/index");
            $crumbs[] = $this->add_crumb(ucfirst($origin[1]), "");
        }elseif($origin[0] === "category"){
            $crumbs[] = $this->add_crumb("Home", "?route=home/index");
            
            if($origin[1] === "show"){
                $crumbs[] = $this->add_crumb(ucfirst($origin[2]), "");
            }elseif($origin[1] === "search"){
                $crumbs[] = $this->add_crumb(ucfirst($origin[1]) . " (" . ucfirst($origin[2]) . ")", "");
            }elseif($origin[1] === "product"){
                if(!filter_var($origin[2], FILTER_VALIDATE_INT)) return false;
                
                $query = 'SELECT title, label, category.url as url FROM product JOIN category ON category_id = category.id WHERE product.id =' .  $origin[2];
                $product_info_breadcrumbs = $this->connection->get_array_from_query($query);
                if(!empty($product_info_breadcrumbs)){
                    $crumbs[] = $this->add_crumb(ucfirst($product_info_breadcrumbs[0]['label']), "?route=category/show/" . $product_info_breadcrumbs[0]['url']);
                    $crumbs[] = $this->add_crumb(ucfirst($product_info_breadcrumbs[0]['title']), "");
                }
            }
        }
        
        $this->print_crumbs($crumbs);
    }
    
    
}

