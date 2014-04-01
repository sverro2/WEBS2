
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
                    <ul class='nav'><li><input type='text' placeholder='Search...' id='searchbar' /></li>
			<li><a href='?route=home/index' class='menuitem'>Home</a></li>
<li id='index'><a href='?route=home/index' class='menuitem'>Products</a>
<ul>
				<li><a href='?route=category/show/portalguns' class='menuitem'>Portal Guns</a></li>
				<li><a href='?route=category/show/turrets' class='menuitem'>Turrets</a></li>
				<li><a href='?route=category/show/neurotoxin' class='menuitem'>Neurotoxin</a></li>
				<li><a href='?route=category/show/misc' class='menuitem'>Misc</a></li>
			</ul>
</li>			<li><a href='?route=home/about' class='menuitem'>About Us</a></li>
			<li><a href='?route=home/shoppingcart' class='menuitem'>Shopping Cart</a></li>
		</ul>
                </div>
            </menu>
            
            <div id="content">
                <div id="breadcrumb">
<a href="?route=home/index"><div class="unselected">Home</div></a><div class="unselected">About</div></div>
<div id="catleft">
	<div class="cat_container">
		<a href="index.php" id="backbutton"> <h1><< BACK</h1> </a>
		<div class='categoryimage' style='background-image: url("img/defaultcategory.png")'>
                    <h1>About Us</h1>
                </div>	
        </div>
</div>

<div id="catmain">
    <div class="productrow">
        <h1>About Aperture Science</h1>
        <div class="description">
            Deze website is gemaakt voor een assessmentopdracht van het vak WEBS2 door Yannick van Hegge en Sven Brettschneider (2062487) uit groep 42IN07SOb.
        </div>
    </div>
</div>            </div>  
        
        <footer></footer>
    </body>
</html>
