<?php
    require 'application/models/session.class.php';
    session_start();
    //session_destroy();
    //print_r($_SESSION['shopping_cart']->get_cart());
    //$_SESSION['shopping_cart']->add_cart(5);
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
        <div id="top_container"></div>
           <a href="index.php"> <header></header></a>
            <menu>
                <div id="menu_alignment">
                    <?php 
                        include 'application/views/elements/menu.class.php'; 
                        
                        $menu_creator = new Structure();
                        $menu_creator->display_menu();
                    ?>
                </div>
            </menu>
            
            <div id="content">
                <?php 
                    $uri = array();
                    if( isset( $_GET['route'] ) ){ 
                        $array_tmp_uri = preg_split('[\\/]', $_GET['route'], -1, PREG_SPLIT_NO_EMPTY);
                        $uri['controller'] = @ $array_tmp_uri[0];
                        $uri['method']     = @ $array_tmp_uri[1];
                        $uri['var']        = @ $array_tmp_uri[2];
                    }
                    else{
                        $uri['controller'] = "home";
                        $uri['method']     = "index"; 
                        $uri['var']        = ""; 
                    }
                    //Load config and base 
                    require_once("application/base.php"); 
                    $application = new application( $uri );
                ?>
            </div>  
        
        <footer></footer>
    </body>
</html>
