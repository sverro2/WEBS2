<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/std.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js">
            
        </script>
        
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
        <div class="main_container">
            <header class="maindiv"></header>
            <menu>
                <div class="right_alignment">
                    <?php 
                        include 'class/menu.class.php'; 
                        
                        $menu_creator = new Structure();
                        $menu_creator->display_menu();
                    ?>
                </div>
            </menu>
            
            <article class="product_container">Artikel</article>
        </div>
        
        <footer></footer>
    </body>
</html>
