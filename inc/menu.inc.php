<?php
require './class/database.class.php';
$database_connection = new database("seventho_webs2");
$query = "SELECT a.id, a.lable, a.link, Deriv1.Count FROM Menu a 
        LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM Menu GROUP BY parent) Deriv1 
        ON a.id = Deriv1.parent";

$menu_item_array = $database_connection->get_array_from_query($query);
var_dump($menu_item_array);

$database_connection->do_sql("SELECT a.id, a.label, a.link, Deriv1.Count FROM `menu` a 
        LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 
        ON a.id = Deriv1.parent WHERE a.parent=" . $parent);

function display_children($parent, $level) { 
    $con = mysqli_connect("localhost", "root", "data", "test");
    $result = $con->query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `menu` a 
        LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 
        ON a.id = Deriv1.parent WHERE a.parent=" . $parent); 
    
    echo "<ul id='nav'>".PHP_EOL; 
    
    while ($row = $result->fetch_assoc()) { 
        if ($row['Count'] > 0) { 
            echo "\t<li><a href='" . $row['link'] . "'>" . $row['label'] . "</a>".PHP_EOL; 
            display_children($row['id'], $level + 1); 
            echo "\t</li>".PHP_EOL; 
        } elseif ($row['Count']==0) { 
            echo "\t<li><a href='" . $row['link'] . "'>" . $row['label'] . "</a></li>" . PHP_EOL; 
        }
    } 
    echo "\t</ul>" . PHP_EOL; 
    
    $con->close();
    $result->close();
} 

