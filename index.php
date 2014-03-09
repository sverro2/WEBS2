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
                        
                        $('ul', this).slideDown();
                    },
                    function () {
                        $('ul', this).slideUp();
                    }
                );
            }
            );
        </script>
    </head>
    <body>
        <div id="top_container"></div>
            <header></header>
            <menu>
                <div id="menu_alignment">
                    <?php 
                        include 'class/menu.class.php'; 
                        
                        $menu_creator = new Structure();
                        $menu_creator->display_menu();
                    ?>
                </div>
            </menu>
            
            <!--<article class="product_container">Artikel</article> -->
            <div id="content">
                <?php include 'pages/home.php' ?>
            </div>
        
        <footer></footer>
    </body>
</html>
