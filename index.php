<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script src="js/main.js"></script>
        
        <script type="text/javascript">
        $(document).ready(
            /* This is the function that will get executed after the DOM is fully loaded */
            function () {
                
                /* Next part of code handles hovering effect and submenu appearing */
                $('.nav li').hover(
                    function () {
                        
                        $('ul', this).stop(true).slideDown("fast");
                    },
                    function () {
                        $('ul', this).stop(true).slideUp("fast");
                    }
                );
            }
            );
        </script>
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
            
            <!--<article class="product_container">Artikel</article> -->
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
