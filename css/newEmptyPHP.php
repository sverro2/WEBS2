
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/std.css" rel="stylesheet" type="text/css"/>
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
                    <ul class='nav'>
			<li><a href='#' id='home'>Home</a></li>
<li id='products'><a href='products'>Products</a>
<ul>
				<li><a href='portal_guns'>Portal Guns</a></li>
				<li><a href='misc'>Misc</a></li>
				<li><a href='neurotoxin'>Neurotoxin</a></li>
				<li><a href='turrets'>Turrets</a></li>
			</ul>
</li>			<li><a href='#' id='about'>About Us</a></li>
			<li><a href='#' id='shopping_cart'>Shopping Cart</a></li>
		</ul>
                </div>
            </menu>
            
            <!--<article class="product_container">Artikel</article> -->
            <div id="content">
                <div id="cat_container">

                    <a href='portal_guns'>
                        <div class='categoryimage'>
                            <h1> Portal Guns</h1>
                            <img src='img/portalguncategory.png'>
                        </div>
                    </a>
                    <a href='turrets'>
                        <div class='categoryimage'>
                            <h1> Turrets</h1>
                            <img src='img/turretcategory.png'>
                        </div>
                    </a>
                    <a href='neurotoxin'>
                        <div class='categoryimage'>
                            <h1> Neurotoxin</h1>
                            <img src=''>
                        </div>
                    </a>
                    <a href='misc'>
                        <div class='categoryimage'>
                            <h1> Misc</h1>
                            <img src='img/misccategory.png'>
                        </div>
                    </a>
                </div>           
            </div>
        
        <footer></footer>
    </body>
</html>
